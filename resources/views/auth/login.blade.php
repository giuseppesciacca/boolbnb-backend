@extends('layouts.app')

@section('script')
@vite(['resources/js/login.js'])
@endsection

@section('content')
<div class="main_login">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 my-5">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>
    
                    <div class="card-body">
                        <form id="custom-form" method="POST" action="{{ route('login') }}">
                            @csrf
    
                            <div class="mb-4 row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}:</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <span id="span-email" class="d-none bg-danger text-dark" role="alert">
                                        <strong>L'email deve essere valida</strong>
                                    </span>
    
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="mb-4 row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}:</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    <span id="span-password" class="d-none bg-danger text-dark" role="alert">
                                        <strong>La password inserita non è corretta</strong>
                                    </span>
    
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="mb-4 row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                                        <label class="form-check-label" for="remember">
                                            {{ __('Ricordami') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
    
                            <div class="mb-4 row mb-0">
                                <div class="col-md-8 offset-md-4 my-4">
                                    <button type="submit" class="btn-1 btn-1-blue me-2">
                                        {{ __('Accedi') }}
                                    </button>
    
                                    @if (Route::has('password.request'))
                                    <a class="text-decoration-none animated-span py-0 fs-6" href="{{ route('password.request') }}">
                                        {{ __('Password dimenticata?') }}
                                    </a>
                                    @endif
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