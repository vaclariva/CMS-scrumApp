@extends('auth.layouts.app')
@section('title')
Login
@endsection
@section('content')
<form method="POST" action="{{ route('login') }}" class="card-body flex flex-col gap-5 p-10">
    @csrf
    <div class="text-center mb-2.5">
        <h3 class="text-lg font-semibold text-gray-900 leading-none mb-2.5">
            Masuk
        </h3>
    </div>

    @if (session('status'))
    <div class="badge badge-sm badge-danger badge-outline rounded-xl px-3.5 py-2.5">
        <div class="text-2sm text-danger">
            {{ session('status') }}
        </div>
    </div>
    @endif

    <div class="flex flex-col gap-1">
        <label class="form-label text-gray-900">
            Email
        </label>
        <input
            type="email"
            name="email"
            id="email"
            class="input"
            placeholder="Masukkan Email"
            value="{{ old('email') }}" />
        @error('email')
        <span class="form-hint text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>
    <div class="flex flex-col gap-1">
        <div class="flex items-center justify-between gap-1">
            <label class="form-label text-gray-900">
                Kata Sandi
            </label>
            @if (Route::has('password.request'))
            <a class="text-2sm link shrink-0" href="{{ route('password.request') }}">
                Lupa Kata Sandi?
            </a>
            @endif
        </div>
        <label class="input" data-toggle-password="true">
            <input
                type="password"
                name="password"
                id="password"
                placeholder="Masukkan Kata Sandi"
                value="" />
            <span class="btn btn-icon" data-toggle-password-trigger="true">
                <i class="ki-filled ki-eye text-gray-500 toggle-password-active:hidden"></i>
                <i class="ki-filled ki-eye-slash text-gray-500 hidden toggle-password-active:block"></i>
            </span>
        </label>
        @error('password')
        <span class="form-hint text-danger">
            {{ $message }}
        </span>
        @enderror
    </div>
    <label class="checkbox-group">
        <input
            type="checkbox"
            name="remember"
            id="remember"
            class="checkbox checkbox-sm"
            value="1" {{ old('remember') ? 'checked' : '' }} />
        <span class="checkbox-label">
            Ingat Saya
        </span>
    </label>
    <button class="rounded-full btn btn-primary flex justify-center grow">
        Masuk
    </button>
    <div class="flex items-center justify-center font-medium">
        <span class="text-2sm text-gray-600 me-1.5">
            Butuh Bantuan?
        </span>
        <a class="text-2sm link" href="#">
            Hubungi Kami
        </a>
    </div>

    <!-- Pastikan token dan email digantikan dengan nilai yang sesuai -->
    <!--<a href="{{ route('password.reset', ['token' => 'example-token', 'email' => 'user@example.com']) }}" class="btn btn-primary">
    Reset Password
</a>-->


</form>


{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

<div class="card-body">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="row mb-3">
            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
                @endif
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>
</div> --}}
@endsection