<?php

namespace App\Jobs;

use App\Models\Contact;
use App\Models\MessageLog;
use App\Services\SmsService;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendBirthdayMessage implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;
    public int $backoff = 60;

    public int $contactId;
    public string $birthdayDate;

    /**
     * Create a new job instance.
     */
    public function __construct(int $contactId, string $birthdayDate)
    {
        $this->contactId = $contactId;
        $this->birthdayDate = $birthdayDate;
    }

    /**
     * Execute the job.
     */
    public function handle(SmsService $sms): void
    {
        $contact = Contact::find($this->contactId);
        if (!$contact) {
            return;
        }

        $today = Carbon::createFromFormat('Y-m-d', $this->birthdayDate, 'GMT');
        $message = "Happy Birthday {$contact->name}!";
        $schedule = $today->format('d-m-Y h:i A');

        $result = $sms->send($contact->telephone1 ?? '', $message, $schedule);

        MessageLog::create([
            'contact_id' => $contact->id,
            'birthday_for' => $contact->birthday,
            'phone' => $contact->telephone1,
            'message' => $message,
            'status' => $result['status'] === 200 ? 'sent' : 'failed',
            'sent_at' => $today,
            'response' => $result['body'],
        ]);
    }
}
