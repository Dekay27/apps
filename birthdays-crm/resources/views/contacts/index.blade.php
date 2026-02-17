@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h1 class="text-2xl font-semibold">Contacts</h1>
                            <div class="text-sm text-gray-500">Search by name or filter by birthday range.</div>
                        </div>
                        <a href="{{ route('contacts.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Add Contact</a>
                    </div>

                    <form method="GET" action="{{ route('contacts.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium mb-1" for="search">Name</label>
                            <input id="search" name="search" type="text" value="{{ $search }}" class="w-full rounded-md border-gray-300" placeholder="Search name" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1" for="date_from">Date From</label>
                            <input id="date_from" name="date_from" type="date" value="{{ $date_from }}" class="w-full rounded-md border-gray-300" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1" for="date_to">Date To</label>
                            <input id="date_to" name="date_to" type="date" value="{{ $date_to }}" class="w-full rounded-md border-gray-300" />
                        </div>
                        <div class="flex items-end gap-2">
                            <button type="submit" class="px-4 py-2 bg-slate-900 text-white rounded-md">Filter</button>
                            <a href="{{ route('contacts.index') }}" class="text-sm text-indigo-600">Reset</a>
                        </div>
                    </form>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="text-left border-b">
                                    <th class="py-2">Name</th>
                                    <th class="py-2">Birthday</th>
                                    <th class="py-2">Phone</th>
                                    <th class="py-2">Email</th>
                                    <th class="py-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($contacts as $contact)
                                    <tr class="border-b">
                                        <td class="py-2 font-medium">{{ $contact->name }}</td>
                                        <td class="py-2">{{ $contact->birthday->format('d M Y') }}</td>
                                        <td class="py-2">{{ $contact->telephone1 }}</td>
                                        <td class="py-2">{{ $contact->email }}</td>
                                        <td class="py-2 text-right">
                                            <a href="{{ route('contacts.edit', $contact) }}" class="text-indigo-600">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="py-4" colspan="5">No contacts found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $contacts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
