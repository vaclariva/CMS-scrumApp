@extends('auth.layouts.app')

@section('title', 'Reset Kata Sandi')

@section('content')


<form method="POST" action="{{ route('password.store') }}" class="card-body flex flex-col gap-5 p-10">
    @csrf

    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div class="text-center mb-2.5">
        <h3 class="text-lg font-semibold text-gray-900 leading-none mb-2.5">
            Reset Kata Sandi
        </h3>
        <div class="flex items-center justify-center font-medium">
            <span class="text-2sm text-gray-600 me-1.5">
                Masukkan kata sandi baru kamu
            </span>
        </div>
    </div>

    @if (session('status'))
        <div class="badge badge-sm badge-danger badge-outline rounded-xl px-3.5 py-2.5">
            <div class="text-2sm text-danger">
                {{ session('status') }}
            </div>
        </div>
    @endif

    <input type="hidden" name="email" value="{{  $request->email }}" required autofocus autocomplete="username"/>
    
    <div class="flex flex-col gap-1">
            <label for="password" class="form-label text-gray-900">
                Kata Sandi Baru
            </label>
        <label class="input" data-toggle-password="true">
            <input 
                type="password" 
                name="password" 
                id="password" 
                required
                placeholder="Masukkan Kata Sandi" 
                value=""
            />
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
    <div class="flex flex-col gap-1">
            <label for="password_confirmation" class="form-label text-gray-900">
                Konfirmasi Kata Sandi Baru
            </label>
        <label class="input" data-toggle-password="true">
            <input 
                type="password" 
                name="password_confirmation" 
                id="password_confirmation" 
                required
                placeholder="Masukkan Kata Sandi" 
                value=""
            />
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
 
    <button class="rounded-full btn btn-primary flex justify-center grow">
        {{ __('Reset Password') }}
    </button>

    
</form>
@endsection
