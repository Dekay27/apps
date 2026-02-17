@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-2xl font-semibold">Birthdays by Month</h1>
                        <a href="{{ route('contacts.import') }}" class="text-sm text-indigo-600 hover:underline">Import Contacts</a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @php
                            $pexelsImages = [
                                'https://images.pexels.com/photos/414171/pexels-photo-414171.jpeg',
                                'https://images.pexels.com/photos/34950/pexels-photo.jpg',
                                'https://images.pexels.com/photos/417173/pexels-photo-417173.jpeg',
                                'https://images.pexels.com/photos/355465/pexels-photo-355465.jpeg',
                                'https://images.pexels.com/photos/462024/pexels-photo-462024.jpeg',
                                'https://images.pexels.com/photos/36717/amazing-animal-beautiful-beautifull.jpg',
                                'https://images.pexels.com/photos/957024/forest-trees-perspective-bright-957024.jpeg',
                                'https://images.pexels.com/photos/1107717/pexels-photo-1107717.jpeg',
                                'https://images.pexels.com/photos/247431/pexels-photo-247431.jpeg',
                                'https://images.pexels.com/photos/1252869/pexels-photo-1252869.jpeg',
                                'https://images.pexels.com/photos/1422408/pexels-photo-1422408.jpeg',
                                'https://images.pexels.com/photos/2662116/pexels-photo-2662116.jpeg',
                            ];
                        @endphp
                        @foreach ($months as $index => $month)
                            @php
                                $monthKey = str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT);
                                $celebrants = $celebrantCounts[$monthKey] ?? 0;
                            @endphp
                            <a href="{{ route('birthdays.show', $index + 1) }}" class="month-card">
                                <img src="{{ $pexelsImages[$index] }}?auto=compress&cs=tinysrgb&w=1200" alt="{{ $month }} birthdays" />
                                <section>
                                    <h2>{{ $month }}</h2>
                                    <p>Tap to view birthdays by week and send messages.</p>
                                    <div>
                                        <div class="tag" aria-label="{{ $celebrants }} celebrants in {{ $month }}">
                                            <span class="dot"></span> {{ $celebrants }} celebrants
                                        </div>
                                        <button type="button">Open</button>
                                    </div>
                                </section>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
