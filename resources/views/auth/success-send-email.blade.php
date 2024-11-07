@extends('auth.layouts.app')

@section('title')
Success send email
@endsection

@section('content')
    <form method="POST" action="{{ route('login') }}" class="card-body flex flex-col gap-5 p-10">
        @csrf
        <div class="text-center mb-2.5">
            <div class="mb-4">
                <img src="{{ asset('metronic/dist/assets/media/images/icon/successicon.svg') }}" alt="Success Icon" class="w-24 h-24 mx-auto">
            </div>
            <h3 class="text-lg font-semibold text-gray-900 leading-none mb-2.5">
                Berhasil Kirim Tautan
            </h3>
            <div class="flex items-center justify-center font-medium">
                <span class="text-2sm text-gray-600 me-1.5">
                    Klik tautan yang dikirim ke email 
                    <strong class="text-primary">{{ session('email') }}</strong> 
                    untuk reset kata sandi.
                </span>
            </div>
        </div>
        <a href="{{ url('/login') }}" class="rounded-full btn btn-primary flex justify-center grow">
            Kembali
        </a>        
        <div class="flex items-center justify-center font-medium">
            <span class="text-2sm text-gray-600 me-1.5">
                Belum menerima email?
            </span>
            <a class="text-2sm link" href="/forgot-password">
                Kirim Ulang
            </a>
        </div>    
    </form>
@endsection
