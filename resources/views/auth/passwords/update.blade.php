@extends('auth.layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-blue-100">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-semibold mb-4 text-center">Reset Kata Sandi</h2>
            <p class="text-gray-600 mb-6 text-center">Masukkan kata sandi baru kamu</p>
            
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-4">
                    <label for="email" class="sr-only">Email</label>
                    <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                        class="w-full p-3 border border-gray-300 rounded-lg @error('email') border-red-500 @enderror" placeholder="Masukkan Email">
                    
                    @error('email')
                        <span class="text-red-500 text-sm">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="sr-only">Kata Sandi Baru</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="w-full p-3 border border-gray-300 rounded-lg @error('password') border-red-500 @enderror" placeholder="Masukkan kata sandi baru">
                    
                    @error('password')
                        <span class="text-red-500 text-sm">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password-confirm" class="sr-only">Konfirmasi Kata Sandi Baru</label>
                    <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password"
                        class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Masukkan ulang kata sandi baru">
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded-lg hover:bg-blue-600">Kirim</button>
            </form>
        </div>
    </div>
@endsection
