<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <a href="{{ route('birthdays.index') }}" class="simple-card">
                            <div>
                                <h2>Birthdays</h2>
                                <p>Browse month cards and weekly lists, then send messages.</p>
                            </div>
                            <span class="simple-action">Open</span>
                        </a>

                        <a href="{{ route('contacts.import') }}" class="simple-card">
                            <div>
                                <h2>Import Contacts</h2>
                                <p>Upload your CSV file to update the birthday database.</p>
                            </div>
                            <span class="simple-action">Open</span>
                        </a>

                        <a href="{{ route('settings.edit') }}" class="simple-card">
                            <div>
                                <h2>SMS Settings</h2>
                                <p>Set API URL, API key, and sender ID for messages.</p>
                            </div>
                            <span class="simple-action">Open</span>
                        </a>

                        <a href="{{ route('contacts.index') }}" class="simple-card">
                            <div>
                                <h2>Contacts</h2>
                                <p>Search, filter, and edit contact details.</p>
                            </div>
                            <span class="simple-action">Open</span>
                        </a>

                        <a href="{{ route('messages.index') }}" class="simple-card">
                            <div>
                                <h2>Message Logs</h2>
                                <p>Review all sent messages with status and time.</p>
                            </div>
                            <span class="simple-action">Open</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
