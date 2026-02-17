@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h1 class="text-2xl font-semibold">Message Logs</h1>
                            <div class="text-sm text-gray-500">All sent messages with status and timestamps.</div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left border-b">
                                    <th class="py-2">Contact</th>
                                    <th class="py-2">Phone</th>
                                    <th class="py-2">Message</th>
                                    <th class="py-2">Status</th>
                                    <th class="py-2">Sent At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($logs as $log)
                                    <tr class="border-b">
                                        <td class="py-2 font-medium">{{ $log->contact?->name ?? 'Unknown' }}</td>
                                        <td class="py-2">{{ $log->phone }}</td>
                                        <td class="py-2">{{ $log->message }}</td>
                                        <td class="py-2">
                                            <span class="px-2 py-1 rounded-full text-xs {{ $log->status === 'sent' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                                                {{ $log->sent_status }}
                                            </span>
                                        </td>
                                        <td class="py-2">{{ optional($log->sent_at)->format('d M Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="py-4" colspan="5">No messages logged yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
