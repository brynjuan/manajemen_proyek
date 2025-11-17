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
            {{-- [DIUBAH] px-6 menjadi px-4 untuk mobile --}}
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center gap-3 flex-shrink-0">
                        <img src="{{ asset('hmti-logo.png') }}" alt="HMTI Logo" class="h-12 w-12 rounded-full object-cover">
                        <div class="text-lg font-semibold text-white">Absensi Rapat</div>
                    </div>
                    
                    {{-- [BARU] Tombol Hamburger (Hanya tampil di mobile) --}}
                    <div class="flex items-center md:hidden">
                        <button data-collapse-toggle="navbar-links" type="button" class="inline-flex items-center justify-center p-2 rounded-lg text-white hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-white" aria-controls="navbar-links" aria-expanded="false">
                            <span class="sr-only">Buka menu</span>
                            <svg class="h-6 w-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>

                    {{-- [DIUBAH] Kontainer link --}}
                    {{-- ID "navbar-links" harus cocok dengan data-collapse-toggle di atas --}}
                    <div class="hidden w-full md:block md:w-auto" id="navbar-links">
                        {{-- Wrapper untuk styling mobile (tumpuk vertikal) dan desktop (horizontal) --}}
                        <div class="flex flex-col p-4 md:p-0 mt-4 rounded-lg bg-blue-800 md:bg-transparent md:flex-row md:items-center md:space-x-8 md:mt-0 md:border-0">
                            @auth
                                @if (auth()->user()->role === 'admin')
                                    {{-- [DIUBAH] Styling link untuk mobile & desktop --}}
                                    <a href="{{ route('admin.dashboard') }}" class="block py-2 px-3 text-white rounded hover:bg-blue-700 md:hover:bg-transparent md:border-0 md:hover:text-gray-200 md:p-0 transition">Home</a>
                                    <a href="{{ route('admin.members.index') }}" class="block py-2 px-3 text-white rounded hover:bg-blue-700 md:hover:bg-transparent md:border-0 md:hover:text-gray-200 md:p-0 transition">Users</a>
                                    <a href="{{ route('admin.profile.show') }}" class="block py-2 px-3 text-white rounded hover:bg-blue-700 md:hover:bg-transparent md:border-0 md:hover:text-gray-200 md:p-0 transition">Profil</a>
                                @else
                                    {{-- [DIUBAH] Styling link untuk mobile & desktop --}}
                                    <a href="{{ route('anggota.dashboard') }}" class="block py-2 px-3 text-white rounded hover:bg-blue-700 md:hover:bg-transparent md:border-0 md:hover:text-gray-200 md:p-0 transition">Home</a>
                                    <a href="{{ route('anggota.contact') }}" class="block py-2 px-3 text-white rounded hover:bg-blue-700 md:hover:bg-transparent md:border-0 md:hover:text-gray-200 md:p-0 transition">Contact</a>
                                    <a href="{{ route('anggota.profile.show') }}" class="block py-2 px-3 text-white rounded hover:bg-blue-700 md:hover:bg-transparent md:border-0 md:hover:text-gray-200 md:p-0 transition">Profil</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}" class="hidden" id="logout-form">
                                    @csrf
                                </form>
                                
                                {{-- [BARU] Tombol Logout untuk Mobile --}}
                                <button type="button" onclick="document.getElementById('logout-form').submit();"
                                    class="block w-full text-left py-2 px-3 text-red-400 rounded hover:bg-blue-700 md:hidden">
                                    Logout
                                </button>
                                
                                {{-- [DIUBAH] Tombol Logout untuk Desktop --}}
                                <button type="button" onclick="document.getElementById('logout-form').submit();"
                                    class="rounded-lg bg-white text-blue-700 px-3 py-2 text-sm font-medium hover:bg-gray-100 transition hidden md:block">
                                    Logout
                                </button>
                            @endauth
                        </div>
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
                        <a href="https://www.instagram.com/hmtiuntad/?utm_source=ig_web_button_share_sheet" class="text-gray-400 hover:text-white transition"><i class="fab fa-instagram"></i></a>
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

