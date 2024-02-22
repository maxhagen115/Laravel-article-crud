@extends('layout')

@section('content')
    <style>
        html {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background: linear-gradient(#141e30, #243b55);
        }
    </style>
    <div class="login-box">
        <h2 class="text-white">Nieuw Wachtwoord</h2><br>
        <form id="reset_ww_post" action="{{ Route('Postresetpwd') }}" method="POST">
            @csrf
            <input type="text" name="token" hidden value="{{$token}}">

            <div class="user-box">
                <input type="email" name="email" required autofocus>
                <label for="email">Email</label>
            </div>

            <div class="user-box">
                <input type="password" name="password" required>
                <label for="password">Nieuw Wachtwoord</label>
            </div>

            <div class="user-box">
                <input type="password" name="password_confirmation" required>
                <label for="password_confirmation">Bevestig nieuw wachtwoord</label>
            </div>

            <div class="login-details">
                <button type="submit" class="login-details-btn">Stel Wachtwoord Opnieuw In</button>
            </div>
        </form>
    </div>

    <script>
        function Login() {
            document.getElementById("reset_ww_post").submit();
        }
    </script>
@endsection
