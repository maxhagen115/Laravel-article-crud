@extends('layout')

@section('content')
    <div class="container mx-auto p-8">
        <h2 class="text-3xl font-bold mb-6">{{ Str::ucfirst($userdata->name) }}</h2>

        <!-- User Information Card -->
        <div class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-lg mb-8">
            <!-- User Profile Picture -->
            <img class="w-32 h-32 object-cover rounded-full mx-4 my-4 float-left"
                src="{{ url('/public/images/profile_picures/' . $userdata->profile_picure) }}" alt="User Image">

            <!-- User Information -->
            <div class="p-4">
                <p class="text-xl font-bold mb-2">{{ Str::ucfirst($userdata->name) }}</p>
                <p class="text-gray-500 mb-2">Gebruiker sinds {{ \Carbon\Carbon::parse($userdata['created_at'])->format('F j, Y') }}</p>
                <p class="text-gray-500">{{ $userdata->email }}</p>
            </div>
            <div class="clear-both"></div>
        </div>

        <!-- User's Blogs Card -->
        @if ($userdata->is_private == 0)
        @if (count($blogdata) > 0)
        <h2 class="text-3xl text-center font-bold mb-6">Blogs van {{ Str::ucfirst($userdata->name) }}</h2>
            @foreach ($blogdata as $blog)
                <div class="max-w-xl mx-auto bg-white rounded-lg overflow-hidden shadow-lg mb-10">
                    <div class="p-4">
                        <!-- Blog List -->
                        <div class="mb-3 border-b border-gray-300 pb-4">
                            <?php
                            $title = $blog->title;
                            if (strlen($title) > 65) {
                                $title = substr($title, 0, 65) . '...';
                            }
                            ?>
                            <a href="/blog/{{ $blog->id }}" class="text-lg font-semibold">{{ $title }}</a>
                            <?php
                            $beschrijving = $blog->beschrijving;
                            if (strlen($beschrijving) > 80) {
                                $beschrijving = substr($beschrijving, 0, 80) . '...';
                            }
                            ?>
                            <p class="text-gray-600">{{ $beschrijving }}</p>
                        </div>
                        <p class="text-gray-500 text-sm">Gemaakt op
                            {{ \Carbon\Carbon::parse($blog['created_at'])->format('F j, Y') }}</p>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-gray-500 text-center">Deze gebruiker heeft nog geen blogs gepost</p>
        @endif
        @else
        <div class="bg-yellow-200 p-6 w-2/6 rounded-lg shadow-md mx-auto">
            <div class="flex items-center">
                <div class="bg-yellow-400 text-yellow-800 rounded-full p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" style="fill: rgb(197, 138, 11);transform: ;msFilter:;"><path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm5 12H7v-4h10v4z"></path></svg>
                </div>
                <div class="ml-4">
                    <p class="text-lg font-semibold text-yellow-800">{{ Str::ucfirst($userdata->name) }} is prive!</p>
                    <p class="text-sm text-yellow-700">Geen zichtbare blogs</p>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection
