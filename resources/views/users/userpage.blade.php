@extends('layout')

@section('content')
    <div class="container mx-auto p-8">
        <h2 class="text-3xl font-bold mb-6">Alle Gebruikers</h2>

        @foreach ($data as $user)
            <!-- User Card -->
            <div class="mb-10 max-w-xl ml-10 bg-white rounded-md overflow-hidden shadow-lg relative">
                <!-- User Image -->
                <img class="w-20 h-20 object-cover rounded-full m-1"
                    src="{{ url('/public/images/profile_picures/' . $user->profile_picure) }}" alt="{{ $user['name'] }}">

                <!-- User Information -->
                <div class="p-4">
                    <p class="text-xl font-bold mb-2">{{ $user['name'] }}</p>
                    <p class="text-gray-500">Account aangemaakt op {{ \Carbon\Carbon::parse($user['created_at'])->format('F j, Y') }}</p>

                </div>

                <!-- "Go to User" Button -->
                <div class="absolute bottom-4 right-4">
                    <a href="/user/{{ $user->id }}"
                        class="inline-flex items-center px-2 py-1 text-sm bg-blue-500 hover:bg-blue-700 text-white font-semibold rounded-full transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:border-blue-700">
                        Ga naar gebruiker
                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
