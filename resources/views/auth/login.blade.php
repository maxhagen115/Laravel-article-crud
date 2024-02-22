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
        <h1>Login</h1>
        <form id="loginPost" action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="user-box">
                <input type="email" name="email" id="email_address" value="{{ old('email') }}" required autofocus>
                <label for="email">Email</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" id="password" value="{{ old('password') }}" required>
                <label>Wachtwoord</label>
            </div>
            <div class="login-details">
                <button type="submit" class="login-details-btn">Login</button>
                <a href="{{ route('register') }}">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Registreer
                </a>
            </div>
            <div class="forgotpwd">
                <a href="{{ route('forgotpwd') }}">Inloggegevens vergeten?</a>
            </div>
        </form>
    </div>

    <script>
        function Login() {
            document.getElementById("loginPost").submit();
        }
    </script>
@endsection
