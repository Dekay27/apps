<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit()
    {
        return view('settings.edit', [
            'arkesel_api_key' => Setting::getValue('arkesel_api_key', config('services.arkesel.api_key')),
            'arkesel_sender_id' => Setting::getValue('arkesel_sender_id', config('services.arkesel.sender_id')),
            'arkesel_api_url' => Setting::getValue('arkesel_api_url', config('services.arkesel.api_url')),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'arkesel_api_key' => ['required', 'string'],
            'arkesel_sender_id' => ['required', 'string', 'max:11'],
            'arkesel_api_url' => ['required', 'url'],
        ]);

        Setting::setValue('arkesel_api_key', $data['arkesel_api_key']);
        Setting::setValue('arkesel_sender_id', $data['arkesel_sender_id']);
        Setting::setValue('arkesel_api_url', $data['arkesel_api_url']);

        return back()->with('status', 'Settings saved.');
    }
}
