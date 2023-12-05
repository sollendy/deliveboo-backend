@extends('layouts.app')

@section('content')


<div class="create-container container">
<div class="row justify-content-center">
        <div class="col-10 col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrazione ristorante') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="username" class="form-label">{{ __('Nome utente') }}</label>
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="restaurant-name" class="form-label">{{ __('Nome attività') }}</label>
                            <input id="restaurant-name" type="text" class="form-control @error('restaurant-name') is-invalid @enderror" name="restaurant-name" value="{{ old('restaurant-name') }}" required autocomplete="restaurant-name" autofocus>
                            @error('restaurant-name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Add similar responsive structure for other form fields -->

                        <div class="mb-3 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Conferma password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrati') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
