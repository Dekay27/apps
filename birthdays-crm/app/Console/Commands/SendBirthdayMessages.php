<?php

namespace App\Console\Commands;

use App\Models\Contact;
use App\Models\MessageLog;
use App\Jobs\SendBirthdayMessage;
use App\Services\SmsService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendBirthdayMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-birthday-messages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send scheduled birthday messages at 12:05 GMT';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now('GMT');
        $month = $today->month;
        $day = $today->day;

        $contacts = Contact::query()
            ->whereMonth('birthday', $month)
            ->whereDay('birthday', $day)
            ->get();

        foreach ($contacts as $contact) {
            SendBirthdayMessage::dispatch($contact->id, $today->toDateString());
        }

        return Command::SUCCESS;
    }
}
