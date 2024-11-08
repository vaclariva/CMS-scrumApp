
@extends('auth.layouts.app')

@section('title')
Success reset
@endsection

@section('content')
    <form method="POST" action="{{ route('login') }}" class="card-body flex flex-col gap-5 p-10">
        @csrf
        <div class="text-center mb-2.5">
            <div class="mb-4">
                <img src="{{ asset('metronic/dist/assets/media/images/icon/successicon.svg') }}" alt="Success Icon" class="w-24 h-24 mx-auto">
            </div>
            <h3 class="text-lg font-semibold text-gray-900 leading-none mb-2.5">
                Kata Sandi Anda Telah Diubah
            </h3>
            <div class="flex items-center justify-center font-medium">
                <span class="text-2sm text-gray-600 me-1.5">
                    Kata sandi Anda telah berhasil diperbarui.
                    Keamanan akun Anda adalah prioritas kami.
                </span>
            </div>
        </div>
        <a href="{{ url('/login') }}" class="rounded-full btn btn-primary flex justify-center grow">
            Masuk
        </a> 
    </form>
@endsection
