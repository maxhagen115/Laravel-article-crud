@extends('layout')

@section('content')
    <button onclick="window.location='{{ route('dashboard') }}'" class="btn-primary m-8">Terug naar Dasboard</button>

    <div class="flex flex-row p-10">
        <div class="basis-1/3 md:flex-1">
            <div class="bg-[#394264] rounded-md margin-auto-top10 h-62 w-72 p-4">
                <form method="post" enctype="multipart/form-data" action="{{ route('saveProfileData') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="block text-gray-300 text-sm font-bold mb-2">Naam</label>
                        <input type="text" name="naam" id="naam" class="form-control"
                            placeholder="Voer hier naam in" value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label class="block text-gray-300 text-sm font-bold mb-2">Email</label>
                        <input type="text" name="email" id="email" class="form-control"
                            placeholder="Voer hier uw Email in" value="{{ $user->email }}">
                    </div>
                    <button type="submit" class="btn-primary">Opslaan</button>
                </form>
            </div>
        </div>

        <div class="basis-1/3 md:flex-1">
            <div class="info block">
                <div class="profile-picture big-profile-picture mb-16 clear">
                    <label for="file">
                        <img id="profile_img" src="/public/images/profile_picures/{{ $user->profile_picure }}">
                        <div class="overlayImg">
                            <img src="/public/images/edit-pencil.png">
                        </div>
                    </label>
                </div>
                <form id="edit-profile-picture" action="{{ route('update-profile-picture') }}" method="post"
                    enctype="multipart/form-data">
                    <input type="file" accept="image/png, image/jpeg" id="file" name="profile_picure"
                        style="display: none;">
                    <input type="submit" name="submit" value="Opslaan" class="btn-primary absolute"
                        style="left: 767px; bottom: 530px; display: none;">
                    @csrf
                </form>
                <h1 class="user-name">{{ Str::ucfirst(Auth::user()->name) }}</h1>
                <div class="profile-description mt-4">
                    <input data-id="{{ $user->id }}" class="toggle-class" type="checkbox" data-onstyle="danger"
                        data-offstyle="primary" data-toggle="toggle" data-on="Prive" data-off="Openbaar"
                        {{ $user->is_private ? 'checked' : '' }}>
                </div>
                <ul class="profile-options horizontal-list">
                    <li class="text-white"><a class="blogs border-t-4 border-yellow-500" href="#"><p><span class="icon bx bxl-blogger scnd-font-color"></span>{{ count($blogs) }}</li></p></a>
                    <li class="text-white"><a class="likes border-t-4 border-red-500" href="#"><p><span class="icon bx scnd-font-color"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" class="relative top-2" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="M374 74.47c-7.1.26-10.8 6.79-4.3 15.89l24-3.41c-6.5-9.11-14.1-12.69-19.7-12.48m-38 9.1c-3.5 0-6.6 1.01-9 2.73c-7.1 5.1-7.6 16.8 7.9 28c-8.9 15.9-29.8 45.8-60.2 43.2l32.1 9.8c-2.7 1.6-5.7 3.1-9.2 4.5C118.7 119.4 29.29 275.1 29.29 275.1c51.1 69.9 4.1 98.9 4.1 98.9l7.81 63h28.81l3.19-41s32.5-3 62.8-63.3c29 9.8 71 9.1 102.6 3.3l-4.1 7.1l-37.4 11.1c31.2 2.8 58.5-2.3 78.7-8.5c-3.4-15.1-4.5-31.5 3.5-52.8L307.2 437h25.9s-4.6-75 34.4-143.5c5-7.8 9.4-15.1 13.1-23.7l2 11.1l-10.5 23.2s39-15.7 29.2-96c23 3.9 45.6 1.7 66.6-4.6c5.3-1.7 9.5-5.8 11.2-11c5-15.6 9.5-32.5 10.4-47.3l-9.7.8c-.2-15.3-21.2-13.1-14.9.8l-10.5.5l-4.9-15.5s16.9-12.3 38.4-7.1c-.9-3.2-2.2-6-3.9-8.6c-13.8-20.8-54.3-27.8-122.4-15.6c-8-12.24-17.8-16.96-25.6-16.93m49.9 33.83c12.4 1.4 21.9 4.3 30.2 9.6h-15.9c-1.6 4.8-7.5 8.4-14.5 8.4s-12.9-3.6-14.5-8.4h-15.5c4.2-3 15.3-9.7 30.2-9.6m9.6 181.6c-15.2 30.3-34.5 33.8-34.5 33.8c-13.4 37.7-10.4 71.8 1.8 103.9H385c-3.8-44.7-3.2-78.4 10.5-137.7m-251.1 50.3L126.6 376l27.2 25.1l13.9 35.6h29.9l-20.1-81.8z" />
                    </svg></span>{{ count($likes) }}</li></p></a>
                    <li class="text-white"><a class="comments border-t-4 border-blue-500" href="#"><p><span class="icon bx bx-comment-detail scnd-font-color"></span>{{ count($comments) }}</li></p></a>
                </ul>
            </div>
        </div>

        <div class="basis-1/3 md:flex-1">

            <div class="bg-[#394264] p-8 rounded-lg shadow-md w-96 margin-auto-top10">
                <h2 class="text-2xl font-bold mb-6 text-white">Verander Wachtwoord</h2>
                <form action="{{ route('update-wachtwoord') }}" method="post">
                    @csrf
                    <!-- Old Password -->
                    <div class="mb-4">
                        <label for="oldPasswordInput" class="block text-gray-300 text-sm font-bold mb-2">Oud wachtwoord</label>
                        <input type="password" name="old_password" id="oldPasswordInput"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:border-blue-500" required>
                    </div>

                    <!-- New Password -->
                    <div class="mb-4">
                        <label for="newPasswordInput" class="block text-gray-300 text-sm font-bold mb-2">Nieuw wachtwoord</label>
                        <input type="password" name="new_password" id="newPasswordInput"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:border-blue-500" required>
                    </div>

                    <!-- Confirm New Password -->
                    <div class="mb-6">
                        <label for="confirmNewPasswordInput" class="block text-gray-300 text-sm font-bold mb-2">Bevestig nieuw wachtwoord</label>
                        <input type="password" name="new_password_confirmation" id="confirmNewPasswordInput"
                            class="w-full px-3 py-2 border rounded focus:outline-none focus:border-blue-500" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-primary">Verander
                        Wachtwoord</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const form = document.getElementById("edit-profile-picture");
        const submitButton = form.querySelector('[type="submit"]');
        const inputFile = form.querySelector('[type="file"]');

        inputFile.addEventListener('change', () => {
            submitButton.style.display = inputFile.files.length ? '' : 'none';
        });
    </script>
@endsection
