@extends('auth.layouts.app')

@section('title')
Send email
@endsection

@section('content')
    <form method="POST" action="{{ route('password.email') }}" class="card-body flex flex-col gap-5 p-10">
        @csrf
        <div class="text-center mb-2.5">
            <h3 class="text-lg font-semibold text-gray-900 leading-none mb-2.5">
                Two Factor
            </h3>
            <div class="flex items-center justify-center font-medium">
                <span class="text-2sm text-gray-600 me-1.5">
                    Masukkan email untuk verifikasi two factor.
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
                placeholder="Masukkan Email" 
                value="{{ old('email') }}"
            />
            @error('email')
                <span class="form-hint text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="self-stretch justify-start items-start gap-2.5 inline-flex">
            <button type="button" class="btn btn-secondary flex justify-center grow rounded-full" onclick="window.location.href='{{ url('/login') }}'">
                Batal
            </button>
            <button type="submit" class="btn btn-primary flex justify-center grow rounded-full">
                Kirim
            </button>
        </div>
    </form>
@endsection

