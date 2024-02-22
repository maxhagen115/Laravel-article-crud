@extends('layout')

@section('content')
    <button onclick="goBack()" class="btn-primary" style="margin-left: 80px;margin-top: 10px;">Terug</button>

    <div class="container mx-auto p-8">
        <h2 class="text-3xl font-bold mb-6 text-center">Bewerk blog</h2>

        <!-- Blog Form -->
        <form method="POST" class="max-w-md mx-auto bg-white rounded-lg overflow-hidden shadow-lg p-6"
            enctype="multipart/form-data" action="{{ url('update-blog') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="mb-4">
                <img src="{{ url('/images/blogimg/' . $data->image) }}" alt="Blog 1"
                    class="mb-4 w-full h-48 object-cover rounded-md">
            </div>
            <!-- Blog Title Input -->
            <div class="mb-4">
                <label for="title" class="text-gray-600 font-semibold mb-2">Title</label>
                <input type="text" id="title" name="title" minlength="1" maxlength="250"
                    value="{{ $data->title }}" required
                    class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500">
            </div>

            <!-- Blog Description Input -->
            <div class="mb-4">
                <label for="description" class="text-gray-600 font-semibold mb-2">Description</label>
                <textarea id="description" value="{{ $data->beschrijving }}" name="beschrijving" required rows="4"
                    class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500">{{ old('beschrijving') ?? $data->beschrijving }}</textarea>
            </div>

            <!-- Blog Picture Upload Input -->
            <div class="mb-4">
                <label for="picture" class="text-gray-600 font-semibold mb-2">Upload Picture</label>
                <input type="file" accept="image/png, image/jpeg" id="image" name="image" value="{{ $data->foto }}"
                    class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-primary">Opslaan</button>
        </form>
    </div>
@endsection
