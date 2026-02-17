<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\MessageLog;
use App\Services\SmsService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request, Contact $contact, SmsService $sms)
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:500'],
        ]);

        $phone = $contact->telephone1;
        if (!$phone) {
            return back()->withErrors(['message' => 'Contact has no primary phone number.']);
        }

        $result = $sms->send($phone, $validated['message']);

        MessageLog::create([
            'contact_id' => $contact->id,
            'birthday_for' => $contact->birthday,
            'phone' => $contact->telephone1,
            'message' => $validated['message'],
            'status' => $result['status'] === 200 ? 'sent' : 'failed',
            'sent_at' => now('GMT'),
            'response' => $result['body'],
        ]);

        return back()->with('status', 'Custom message sent.');
    }
}
