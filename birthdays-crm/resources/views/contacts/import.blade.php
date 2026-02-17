@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-semibold mb-4">Import Contacts</h1>

                    @if ($errors->any())
                        <div class="mb-4 text-sm text-red-600">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('contacts.import.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1" for="csv_file">CSV File</label>
                            <input id="csv_file" name="csv_file" type="file" class="block w-full" required />
                            <div class="text-xs text-gray-500 mt-1">Expected headers: Name, Date, Notes, Telephone1, Telephone2, Telephone3, Email</div>
                        </div>
                        <div class="flex items-center gap-2">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Import</button>
                            <a href="{{ route('birthdays.index') }}" class="text-sm text-indigo-600 hover:underline">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
