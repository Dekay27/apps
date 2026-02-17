<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactImportController extends Controller
{
    public function create()
    {
        return view('contacts.import');
    }

    public function store(Request $request)
    {
        $request->validate([
            'csv_file' => ['required', 'file', 'mimes:csv,txt'],
        ]);

        $path = $request->file('csv_file')->storeAs('imports', 'birthdays.csv');
        $fullPath = Storage::path($path);
        $rows = array_map('str_getcsv', file($fullPath));

        if (count($rows) < 2) {
            return back()->withErrors(['csv_file' => 'CSV appears empty.']);
        }

        $headers = array_map('trim', $rows[0]);
        $expected = ['Name', 'Date', 'Notes', 'Telephone1', 'Telephone2', 'Telephone3', 'Email'];
        if ($headers !== $expected) {
            return back()->withErrors(['csv_file' => 'CSV headers do not match expected format.']);
        }

        $created = 0;
        foreach (array_slice($rows, 1) as $row) {
            if (count($row) < 7) {
                continue;
            }

            [$name, $date, $notes, $tel1, $tel2, $tel3, $email] = $row;
            $name = trim($name);
            $date = trim($date);

            if ($name === '' || $date === '') {
                continue;
            }

            $birthday = \DateTime::createFromFormat('d/m/Y', $date);
            if (!$birthday) {
                continue;
            }

            Contact::updateOrCreate(
                ['name' => $name, 'birthday' => $birthday->format('Y-m-d')],
                [
                    'notes' => trim($notes) ?: null,
                    'telephone1' => trim($tel1) ?: null,
                    'telephone2' => trim($tel2) ?: null,
                    'telephone3' => trim($tel3) ?: null,
                    'email' => trim($email) ?: null,
                ]
            );
            $created++;
        }

        return redirect()->route('birthdays.index')->with('status', "Imported {$created} contacts.");
    }
}
