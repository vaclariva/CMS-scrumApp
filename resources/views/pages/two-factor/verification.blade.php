@extends('auth.layouts.app')

@section('title')
Verification
@endsection

@section('content')
    <form method="POST" action="{{ route('verify.validate') }}" class="card-body flex flex-col gap-5 p-10">
        @csrf
                <div class="text-center mb-2.5">
            <div class="mb-4">
                <img src="{{ asset('metronic/dist/assets/media/images/icon/smartphone.svg') }}" alt="Success Icon" class="w-24 h-24 mx-auto">
            </div>
            <h3 class="text-lg font-semibold text-gray-900 leading-none mb-2.5">
                Cek Email Kamu
            </h3>
            <div class="flex items-center justify-center font-medium">
                <span class="text-2sm text-gray-600 me-1.5">
                    Masukkan kode verifikasi yang kami kirim ke 
                    <strong class="text-primary">{{ $email }}</strong> 
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

        {{-- Menampilkan pesan error dari session --}}
        @if (session('error'))
            <div class="badge badge-sm badge-danger badge-outline rounded-xl px-3.5 py-2.5" id="alert-error">
                <div class="text-2sm text-danger">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <div class="badge badge-sm badge-success badge-outline rounded-xl px-3.5 py-2.5 hidden" id="alert-success">
            Kami sudah mengirimkan email yang berisi kode untuk proses login Anda.
        </div>

        <div class="badge badge-sm badge-danger badge-outline rounded-xl px-3.5 py-2.5 hidden" id="alert-error"></div>
        
        <div class="flex flex-col gap-1">
            <input 
                type="text" 
                name="two_factor_code" 
                id="code" 
                class="input" 
                placeholder="Masukkan Kode Verifikasi" 
                value="{{ old('two_factor_code') }}"
            />
            @error('email')
                <span class="form-hint text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="flex items-center justify-center font-medium">
            {{-- <span class="text-2sm text-gray-600 me-1.5">
                Belum menerima kode?
            </span> --}}
            {{-- <a class="text-2sm link" href="#">
                Kirim ulang
            </a> --}}
            <span class="text-2sm text-gray-600 me-1.5">Belum menerima kode?? <a type="button" class="text-2sm link" onclick="resendCode({el: this, url: '{{ route('verify.resend-two-factor') }}', token: '{{ csrf_token() }}' })">Kirim Ulang</a></span>
            <span class="spinner hidden" id="loader"></span>
        </div>

        <div class="self-stretch justify-start items-start gap-2.5 inline-flex">
            <button type="submit" class="rounded-full btn btn-primary flex justify-center grow">
                Lanjut
            </button> 
        </div>
    </form>

    @push('blockfoot')
        <script src="{{ asset('assets/js/auth/two-factor.js') }}"></script>
    @endpush
@endsection
