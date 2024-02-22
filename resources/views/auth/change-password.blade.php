@extends('layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verander Wachtwoord') }}</div>

                    <form action="{{ route('update-wachtwoord') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="oldPasswordInput" class="form-label">Oud Wachtwoord</label>
                                <input name="old_password" type="password" class="form-control" id="oldPasswordInput" required
                                    placeholder="Oud Wachtwoord">
                            </div>
                            <div class="mb-3">
                                <label for="newPasswordInput" class="form-label">Nieuwe Wachtwoord</label>
                                <input name="new_password" type="password" class="form-control" id="newPasswordInput" required
                                    placeholder="Nieuwe Wachtwoord">
                            </div>
                            <div class="mb-3">
                                <label for="confirmNewPasswordInput" class="form-label">Bevestig Nieuwe Wachtwoord</label>
                                <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput" required
                                    placeholder="Bevestig Nieuwe Wachtwoord">
                            </div>

                        </div>

                        <div class="card-footer">
                            <button class="btn btn-success">Opslaan</button>
                            <button onclick="goBack()" class="btn-primary">Terug</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
