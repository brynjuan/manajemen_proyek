<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @hasSection('title')
            @yield('title') |
        @endif
        Absensi Rapat
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="text-slate-900">
    <div class="min-h-screen flex flex-col" style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);">
        <!-- Navbar -->
        <nav class="bg-gradient-to-r from-blue-900 to-blue-700 shadow-lg">
            <div class="max-w-7xl mx-auto px-6 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('hmti-logo.png') }}" alt="HMTI Logo" class="h-12 w-12 rounded-full object-cover">
                        <div class="text-lg font-semibold text-white">Absensi Rapat</div>
                    </div>
                    <div class="flex items-center gap-8">
                        @auth
                            @if (auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-white hover:text-gray-200 transition">Home</a>
                                <a href="{{ route('admin.members.index') }}" class="text-sm font-medium text-white hover:text-gray-200 transition">Users</a>
                                <a href="{{ route('admin.profile.show') }}" class="text-sm font-medium text-white hover:text-gray-200 transition">Profil</a>
                            @else
                                <a href="{{ route('anggota.dashboard') }}" class="text-sm font-medium text-white hover:text-gray-200 transition">Home</a>
                                <a href="{{ route('anggota.contact') }}" class="text-sm font-medium text-white hover:text-gray-200 transition">Contact</a>
                                <a href="{{ route('anggota.profile.show') }}" class="text-sm font-medium text-white hover:text-gray-200 transition">Profil</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="hidden" id="logout-form">
                                @csrf
                            </form>
                            <button type="button" onclick="document.getElementById('logout-form').submit();"
                                class="rounded-lg bg-white text-blue-700 px-3 py-2 text-sm font-medium hover:bg-gray-100 transition">
                                Logout
                            </button>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-1 flex items-center justify-center px-4 py-12">
            {{-- Allow child views to override the container width via @section('container-class', 'max-w-7xl') --}}
            <div class="w-full @yield('container-class', 'max-w-sm') mx-auto">
                @if (session('success') && ! $__env->hasSection('suppress-success'))
                    <div id="success-alert" class="mb-4 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800" role="alert">
                        <div class="font-semibold mb-2">Terjadi kesalahan:</div>
                        <ul class="list-inside list-disc space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-6">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex items-center justify-between">
                    <div class="flex gap-6">
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-tiktok"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-linkedin"></i></a>
                    </div>
                    <div class="text-sm text-gray-400">
                        &copy; HMTI, 2025. All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @yield('scripts')
</body>

</html>

