@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="max-w-md mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">🔐 Login</h1>

    <div class="bg-white rounded-xl shadow p-6">
        <form action="/login" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>

            <button type="submit"
                class="gradient-btn text-white w-full py-2 rounded-lg text-sm font-medium hover:opacity-90 transition">
                Login
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-4">
            Belum punya akun?
            <a href="/register" class="text-green-600 font-medium hover:underline">Daftar sekarang</a>
        </p>
    </div>
</div>

@endsection