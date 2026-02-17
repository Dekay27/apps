@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-semibold mb-4">SMS Settings</h1>

                    @if (session('status'))
                        <div class="mb-4 text-sm text-green-600">{{ session('status') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-4 text-sm text-red-600">{{ $errors->first() }}</div>
                    @endif

                    <form method="POST" action="{{ route('settings.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1" for="arkesel_api_url">API URL</label>
                            <input id="arkesel_api_url" name="arkesel_api_url" type="text" class="block w-full rounded-md border-gray-300" value="{{ $arkesel_api_url }}" required />
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1" for="arkesel_api_key">Arkesel API Key</label>
                            <input id="arkesel_api_key" name="arkesel_api_key" type="text" class="block w-full rounded-md border-gray-300" value="{{ $arkesel_api_key }}" required />
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1" for="arkesel_sender_id">Sender ID</label>
                            <input id="arkesel_sender_id" name="arkesel_sender_id" type="text" class="block w-full rounded-md border-gray-300" value="{{ $arkesel_sender_id }}" required />
                        </div>

                        <div class="flex items-center gap-2">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Save</button>
                            <a href="{{ route('birthdays.index') }}" class="text-sm text-indigo-600 hover:underline">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
