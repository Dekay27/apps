<?php

namespace App\Http\Controllers;

use App\Models\MessageLog;
use Illuminate\Http\Request;

class MessageLogController extends Controller
{
    public function index(Request $request)
    {
        $logs = MessageLog::query()
            ->with('contact')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('messages.index', [
            'logs' => $logs,
        ]);
    }
}
