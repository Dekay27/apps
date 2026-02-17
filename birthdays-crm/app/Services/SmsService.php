<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;

class SmsService
{
    public function send(string $phone, string $message, ?string $schedule = null): array
    {
        $baseUrl = Setting::getValue('arkesel_api_url', config('services.arkesel.api_url'));

        $apiKey = Setting::getValue('arkesel_api_key', config('services.arkesel.api_key'));
        $senderId = Setting::getValue('arkesel_sender_id', config('services.arkesel.sender_id'));

        $payload = [
            'action' => 'send-sms',
            'api_key' => $apiKey,
            'to' => $phone,
            'from' => $senderId,
            'sms' => $message,
        ];

        if ($schedule) {
            $payload['schedule'] = $schedule;
        }

        $response = Http::retry(3, 200, null, false)
            ->get($baseUrl, $payload);

        $result = [
            'status' => $response->status(),
            'body' => $response->body(),
        ];

        Log::info('Arkesel SMS response', [
            'to' => $phone,
            'status' => $result['status'],
            'body' => $result['body'],
        ]);

        return $result;
    }
}
