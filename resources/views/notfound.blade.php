@extends('layout')

@section('content')

<div class="bg-gray-100 font-sans flex items-center justify-center h-full">
  <div class="text-center">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">404 - Not Found</h1>
    <p class="text-lg text-gray-600">The page you are looking for might be in another universe.</p>
    <a href="{{ route('dashboard') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-500 text-white font-semibold rounded-full transition duration-300 ease-in-out hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
      Dashboard
    </a>
  </div>
</div>

@endsection
