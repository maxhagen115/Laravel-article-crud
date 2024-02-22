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
    <div class="login-box" style="width: 560px;">
        <h2 class="text-white">Wachtwoord vergeten?</h2>
        <h5 class="text-white">Vul je email adres hieronder in om een email te versturen</h5><br>
        <form id="request_ww_post" action="{{ Route('Postforgotpwd') }}" method="POST">
            @csrf
            <div class="user-box">
                <input type="email" name="email" id="email_address" value="{{ old('email') }}" required autofocus>
                <label for="email">Email</label>
            </div>
            <div class="login-details">
                <button type="submit" class="login-details-btn">Verstuur Email</button>
                <a href="{{ route('login') }}">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Terug Naar Login
                </a>
            </div>
        </form>
    </div>

    <script>
        function Login() {
            document.getElementById("request_ww_post").submit();
        }
    </script>
@endsection
