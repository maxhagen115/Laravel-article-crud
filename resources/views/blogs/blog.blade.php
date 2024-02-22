@extends('layout')

@section('content')
    <a href="{{ url('/blogs') }}" class="btn-primary pull-left ml-10 mt-10">Terug</a>
    <div class="container mx-auto p-8">

        <!-- Blog Card -->
        <div class="max-w-4xl mx-auto bg-white rounded-lg overflow-hidden shadow-lg">
            <!-- Blog Picture -->
            <img class="w-full h-64 object-cover" src="{{ url('/images/blogimg/' . $blog->image) }}" alt="Blog Image">

            <!-- Blog Content -->
            <div class="p-6">
                <!-- Blog Title -->
                <h1 class="text-3xl font-bold mb-4 break-words">{{ ucfirst($blog->title) }}</h1>

                <!-- Blog Description -->
                <p class="text-gray-700 mb-4 break-words">{{ ucfirst($blog->beschrijving) }}</p>

                <!-- Like and Comment Section -->
                <div class="flex items-center text-gray-500 space-x-4">
                    <!-- Like Button -->

                    <div class="flex items-center focus:outline-none">
                        @include('blogs.like', ['model' => $blog])
                    </div>

                    <!-- Geschreven door -->
                    <div class="flex items-center">
                        <span class="font-semibold">Geschreven door {{ $blog->user_name }}</span>
                    </div>

                    @if (Auth::user()->id === $blog->user_id)
                        <div class="flex items-center">
                            <a href="{{ url('edit-blog/' . $blog->id) }}" class="btn-warning mx-3">Bewerk</a>
                            <form method="POST" action="{{ url('delete-blog/' . $blog->id) }}">
                                @csrf
                                <input name="_method" type="hidden" value="GET">
                                <button type="submit" class="btn-danger show_confirm" data-toggle="tooltip"
                                    title='Delete'>Verwijder</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
         <!-- reacties section -->
        <livewire:comments :model="$blog"/>
    </div>


    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Weet je zeker dat je deze blog wilt verwijderen?`,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    position: 'top-start',
                    buttons: ["Nee", "Ja"],
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endsection
