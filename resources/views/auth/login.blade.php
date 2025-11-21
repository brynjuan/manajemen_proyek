@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <!-- Card Login -->
    <div class="rounded-2xl bg-[#424fb3] shadow-slate-900/40 p-10 shadow-2xl">
        <h1 class="mb-8 text-2xl font-bold text-white text-center tracking-widest">LOGIN</h1>
        
        <form method="POST" action="{{ route('login.perform') }}" class="space-y-5">
            @csrf
            
            <!-- Email Input -->
            <div class="flex items-center gap-3">
                <div class="text-white text-lg">
                    <i class="fas fa-user-circle"></i>
                </div>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                    class="flex-1 px-3 py-2 rounded-md bg-white text-slate-900 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-white">
            </div>

            <!-- Password Input -->
            <div class="flex items-center gap-3">
                <div class="text-white text-lg">
                    <i class="fas fa-lock"></i>
                </div>
                <input id="password" name="password" type="password" required
                    class="flex-1 px-3 py-2 rounded-md bg-white text-slate-900 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-white">
                
                <!-- Tombol Mata -->
                <button type="button" onclick="togglePassword()" 
                    class="text-white text-lg focus:outline-none">
                    <i id="toggleIcon" class="fas fa-eye"></i>
                </button>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full rounded-md bg-white text-blue-600 px-4 py-2.5 font-semibold transition hover:bg-gray-50 shadow-lg mt-6">
                LOGIN
            </button>
        </form>
    </div>

    @section('scripts')
        <script>
            function togglePassword() {
                const passwordInput = document.getElementById('password');
                const toggleIcon = document.getElementById('toggleIcon');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('fa-eye');
                    toggleIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('fa-eye-slash');
                    toggleIcon.classList.add('fa-eye');
                }
            }
        </script>
    @endsection
@endsection