@extends('layout')

@section('content')
    <button onclick="goBack()" class="btn-primary" style="margin-left: 80px;margin-top: 10px;">Terug</button>

    <div class="container mx-auto p-8">
        <h2 class="text-3xl font-bold mb-6 text-center">Voeg een blog toe</h2>

        <!-- Blog Form -->
        <form method="POST" class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-lg p-6" enctype="multipart/form-data" action="{{ url('save-blog') }}">
            @csrf
            <!-- Blog Title Input -->
            <div class="mb-4">
                <label for="title" class="text-gray-600 font-semibold mb-2">Titel</label>
                <input type="text" id="title" name="title" minlength="1" maxlength="250" value="{{ old('title') }}" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500">
            </div>

            <!-- Blog Description Input -->
            <div class="mb-4">
                <label for="beschrijving" class="text-gray-600 font-semibold mb-2">Beschrijving</label>
                <input id="beschrijving" name="beschrijving" dusk='beschrijving-input' value="{{ old('beschrijving') }}" required rows="4" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500">
            </div>

            <!-- Blog Picture Upload Input -->
            <div class="mb-4">
                <label for="picture" class="text-gray-600 font-semibold mb-2">Foto</label>
                <input type="file" accept="image/png, image/jpeg" id="image" name="image" value="{{ old('image') }}" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-primary">Opslaan</button>
        </form>
    </div>

@endsection
