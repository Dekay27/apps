<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('search')) {
            $search = $request->string('search');
            $query->where('name', 'like', '%'.$search.'%');
        }

        if ($request->filled('date_from')) {
            $query->whereDate('birthday', '>=', $request->date('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('birthday', '<=', $request->date('date_to'));
        }

        $contacts = $query->orderBy('name')->paginate(15)->withQueryString();

        return view('contacts.index', [
            'contacts' => $contacts,
            'search' => $request->string('search')->toString(),
            'date_from' => $request->input('date_from'),
            'date_to' => $request->input('date_to'),
        ]);
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateContact($request);
        $data['birthday'] = Carbon::createFromFormat('Y-m-d', $data['birthday'])->format('Y-m-d');

        Contact::create($data);

        return redirect()->route('contacts.index')->with('status', 'Contact created.');
    }

    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $data = $this->validateContact($request);
        $data['birthday'] = Carbon::createFromFormat('Y-m-d', $data['birthday'])->format('Y-m-d');

        $contact->update($data);

        return redirect()->route('contacts.index')->with('status', 'Contact updated.');
    }

    private function validateContact(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'birthday' => ['required', 'date_format:Y-m-d'],
            'notes' => ['nullable', 'string'],
            'telephone1' => ['nullable', 'string', 'max:50'],
            'telephone2' => ['nullable', 'string', 'max:50'],
            'telephone3' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
        ]);
    }
}
