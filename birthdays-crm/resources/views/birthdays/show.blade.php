@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h1 class="text-2xl font-semibold">{{ $month }} Birthdays</h1>
                            <div class="text-sm text-gray-500">Grouped by week</div>
                        </div>
                        <a href="{{ route('birthdays.index') }}" class="text-sm text-indigo-600 hover:underline">Back to months</a>
                    </div>

                    @forelse ($contacts as $week => $people)
                        <div class="mb-8">
                            <h2 class="text-lg font-semibold mb-4">{{ $week }}</h2>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                @foreach ($people as $contact)
                                    <div class="contact-card">
                                        <section>
                                            <div>
                                                <h3>{{ $contact->name }}</h3>
                                                <p class="muted">{{ $contact->birthday->format('d M') }}</p>
                                                @if ($contact->notes)
                                                    <p class="muted">{{ $contact->notes }}</p>
                                                @endif
                                            </div>
                                            <div class="tag" aria-label="Primary phone">
                                                <span class="dot"></span> {{ $contact->telephone1 ?? 'No phone' }}
                                            </div>
                                        </section>

                                        <div class="meta">
                                            <span>{{ $contact->email ?? 'No email' }}</span>
                                            <span>{{ $contact->telephone2 ?? '' }}</span>
                                        </div>

                                        <form method="POST" action="{{ route('contacts.messages.store', $contact) }}">
                                            @csrf
                                            <div class="flex gap-2">
                                                <input type="text" name="message" placeholder="Send a personalized message" class="flex-1 rounded-md border-gray-300" />
                                                <button type="submit" class="contact-action">Send</button>
                                            </div>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div>No birthdays found for this month.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
