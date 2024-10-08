<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($user)
                        <h3>{{ $user->name }} {{ $user->surname }}</h3>
                        <p>Email: {{ $user->email }}</p>
                        @if($user->userMeta)
                            <p>Address: {{ $user->userMeta->address ?? 'N/A' }}</p>
                            <p>City: {{ $user->userMeta->city ?? 'N/A' }}</p>
                            <p>Province: {{ $user->userMeta->province ?? 'N/A' }}</p>
                            <p>ZIP Code: {{ $user->userMeta->zip_code ?? 'N/A' }}</p>
                            <p>Country: {{ $user->userMeta->country->name ?? 'N/A' }}</p>
                        @else
                            <p>No additional information available.</p>
                        @endif
                    @else
                        <p>User not found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>