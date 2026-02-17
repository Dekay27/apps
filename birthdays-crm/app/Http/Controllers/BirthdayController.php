<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Carbon\Carbon;

class BirthdayController extends Controller
{
    public function index()
    {
        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::createFromDate(null, $month, 1)->format('F');
        });

        $celebrantCounts = Contact::query()
            ->selectRaw('strftime("%m", birthday) as month, count(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        return view('birthdays.index', [
            'months' => $months,
            'celebrantCounts' => $celebrantCounts,
        ]);
    }

    public function show(int $month)
    {
        $month = max(1, min(12, $month));
        $start = Carbon::createFromDate(null, $month, 1)->startOfMonth();
        $end = $start->copy()->endOfMonth();

        $contacts = Contact::query()
            ->whereMonth('birthday', $month)
            ->orderByRaw("cast(strftime('%d', birthday) as integer) asc")
            ->get()
            ->groupBy(function (Contact $contact) use ($start) {
                $day = $contact->birthday->day;
                $week = intdiv(($day - 1), 7) + 1;
                return 'Week '.$week;
            });

        return view('birthdays.show', [
            'month' => $start->format('F'),
            'monthNumber' => $month,
            'contacts' => $contacts,
        ]);
    }
}
