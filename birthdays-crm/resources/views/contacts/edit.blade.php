@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-semibold mb-4">Edit Contact</h1>

                    @if ($errors->any())
                        <div class="mb-4 text-sm text-red-600">{{ $errors->first() }}</div>
                    @endif

                    <form method="POST" action="{{ route('contacts.update', $contact) }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @csrf
                        @method('PUT')

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-1" for="name">Name</label>
                            <input id="name" name="name" type="text" class="w-full rounded-md border-gray-300" value="{{ old('name', $contact->name) }}" required />
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1" for="birthday">Birthday</label>
                            <input id="birthday" name="birthday" type="date" class="w-full rounded-md border-gray-300" value="{{ old('birthday', $contact->birthday->format('Y-m-d')) }}" required />
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1" for="email">Email</label>
                            <input id="email" name="email" type="email" class="w-full rounded-md border-gray-300" value="{{ old('email', $contact->email) }}" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1" for="telephone1">Telephone 1</label>
                            <input id="telephone1" name="telephone1" type="text" class="w-full rounded-md border-gray-300" value="{{ old('telephone1', $contact->telephone1) }}" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1" for="telephone2">Telephone 2</label>
                            <input id="telephone2" name="telephone2" type="text" class="w-full rounded-md border-gray-300" value="{{ old('telephone2', $contact->telephone2) }}" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1" for="telephone3">Telephone 3</label>
                            <input id="telephone3" name="telephone3" type="text" class="w-full rounded-md border-gray-300" value="{{ old('telephone3', $contact->telephone3) }}" />
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-1" for="notes">Notes</label>
                            <textarea id="notes" name="notes" class="w-full rounded-md border-gray-300" rows="3">{{ old('notes', $contact->notes) }}</textarea>
                        </div>

                        <div class="md:col-span-2 flex items-center gap-2">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Save</button>
                            <a href="{{ route('contacts.index') }}" class="text-sm text-indigo-600">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
