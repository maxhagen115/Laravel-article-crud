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
    <div class="register-box">
        <h1>Registreer</h1>
        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div class="user-box">
                <input type="text" name="name" id="name" value="{{ old('name') }}" autofocus>
                <label>Naam</label>
            </div>
            <div class="user-box">
                <input type="email" name="email" id="email_address" value="{{ old('email') }}">
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" id="password" value="{{ old('password') }}">
                <label>Wachtwoord</label>
            </div>
            <div class="register-details">
                <button type="submit" class="register-details-btn">registreer</button>
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
@endsection
