@extends('auth.layouts.app')
@section('content')
    <form method="POST" action="{{ route('password.email') }}" class="card-body flex flex-col gap-5 p-10">
        @csrf
        <div class="text-center mb-2.5">
            <h3 class="text-lg font-semibold text-gray-900 leading-none mb-2.5">
                Reset Password
            </h3>
            <div class="flex items-center justify-center font-medium">
                <span class="text-2sm text-gray-600 me-1.5">
                    Masukkan alamat email untuk
                    <br />mengatur ulang password.
                </span>
            </div>
        </div>

        @if (session('status'))
            <div class="badge badge-sm badge-success badge-outline rounded-xl px-3.5 py-2.5">
                <div class="text-2sm text-success">
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
                placeholder="email@email.com" 
                value="{{ old('email') }}"
            />
            @error('email')
                <span class="form-hint text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary flex justify-center grow">
            Continue
        </button>

        <div class="flex items-center justify-center font-medium">
            <span class="text-2sm text-gray-600 me-1.5">
                Sudah ingat?
            </span>
            <a class="text-2sm link" href="{{ url('/login') }}">
                Login
            </a>
        </div>
    </form>
@endsection

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
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

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
