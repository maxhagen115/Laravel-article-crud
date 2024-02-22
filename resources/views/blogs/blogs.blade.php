@extends('layout')

@section('content')

    <div class="p-8">
        <a href="{{ route('add-blog') }}" class="btn-primary">Voeg Blog Toe</a>
    </div>
    <div class="max-w-screen-md mx-auto p-8">
        @if (count($data) > 0)
            <h2 class="text-3xl font-bold mb-6">Blogs</h2>
            <div class="grid grid-cols-1 gap-6">

                @foreach ($data as $blog)
                    <!-- Blog Item 1 -->
                    <div class="bg-white p-8 rounded-lg shadow-md mb-6">
                        <!-- Blog Image -->
                        <img src="{{ url('/images/blogimg/' . $blog->image) }}" alt="Blog 1"
                            class="mb-4 w-full h-48 object-cover rounded-md">
                        <!-- Blog Title -->
                        <?php
                        $title = $blog->title;
                        if (strlen($title) > 20) {
                            $title = substr($title, 0, 20) . '...';
                        }
                        ?>
                        <h2><a href="/blog/{{ $blog->id }}" class="text-2xl font-semibold mb-2">{{ $title }}</a>
                        </h2>

                        <!-- Blog Created At -->
                        <p class="text-gray-600 text-sm mb-2">Geschreven op {{ \Carbon\Carbon::parse($blog['created_at'])->format('F j, Y') }}
                            Door {{ $blog->user_name }}</p>
                    </div>
                @endforeach
            </div>
        @else
        <h2 class="text-3xl font-bold mb-6">Geen blogs!</h2>
        <h2 class="text-2xl font-bold mb-6">Ben jij de eerste die een blog aanmaakt?</h2>
        @endif
    </div>
@endsection
