@extends('layout')

@section('content')

<div class="container mx-auto p-8">
    <h2 class="text-3xl font-bold mb-6">Dashboard</h2>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">
        <!-- Total Users -->
        <div class="bg-blue-200 p-6 rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <span class="text-lg font-semibold">Totaal aantal gebruikers</span>
                <span class="text-3xl font-bold text-blue-800">{{ $totalUsers }}</span>
            </div>
        </div>

        <!-- Total Blogs -->
        <div class="bg-green-200 p-6 rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <span class="text-lg font-semibold">Totaal aantal blogs</span>
                <span class="text-3xl font-bold text-green-800">{{ $totalBlogs }}</span>
            </div>
        </div>

        <!-- Blogs of Today -->
        <div class="bg-yellow-200 p-6 rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <span class="text-lg font-semibold">Blogs van vandaag</span>
                <span class="text-3xl font-bold text-yellow-800">{{ $todayBlogs }}</span>
            </div>
        </div>

        <!-- Blogs This Month -->
        <div class="bg-red-200 p-6 rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <span class="text-lg font-semibold">Blogs deze maand</span>
                <span class="text-3xl font-bold text-red-800">{{ $thisMonthBlogs }}</span>
            </div>
        </div>

        <!-- Total Blogs This Year -->
        <div class="bg-purple-200 p-6 rounded-lg shadow-md">
            <div class="flex items-center justify-between">
                <span class="text-lg font-semibold">Totale blogs dit jaar</span>
                <span class="text-3xl font-bold text-purple-800">{{ $thisYearBlogs }}</span>
            </div>
        </div>
    </div>
</div>


    <script>
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Weet je zeker dat je wilt uitloggen?`,
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
