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
                <div class="flex flex-wrap items-center justify-between mx-auto p-4">

                
                    <div class="flex items-center gap-3 flex-shrink-0">
                        <img src="{{ asset('hmti-logo.png') }}" alt="HMTI Logo" class="h-12 w-12 rounded-full object-cover">
                        <div class="text-lg font-semibold text-white">Absensi Rapat</div>
                    </div>
                    
                    {{-- [BARU] Tombol Hamburger (Hanya tampil di mobile) --}}
                   {{-- Tombol Hamburger (Hanya tampil jika BUKAN halaman login) --}}
                    @unless(request()->routeIs('login.show'))
                        <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-default" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                                <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                            </svg>
                        </button>
                        {{-- Menu Links --}}
                        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
<ul class="font-medium flex flex-col p-4 md:p-0 mt-4 
    border border-gray-100 rounded-lg bg-gray-50 
    md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 
    md:border-none md:bg-transparent">

@auth
    @if (auth()->user()->role === 'admin')
        <li>
            <a href="{{ route('admin.dashboard') }}"
                class="block py-2 px-3 rounded 
                       hover:bg-gray-100 
                       md:hover:bg-transparent 
                       md:border-0 
                       md:text-white 
                       md:hover:text-gray-200 
                       md:p-0
                       {{ request()->routeIs('admin.dashboard') 
                            ? 'text-blue-700 md:text-yellow-300' 
                            : 'text-gray-900 md:text-white' }}">
                Home
            </a>
        </li>

        <li>
            <a href="{{ route('admin.members.index') }}"
                class="block py-2 px-3 rounded
                       hover:bg-gray-100
                       md:hover:bg-transparent
                       md:border-0
                       md:text-white
                       md:hover:text-gray-200
                       md:p-0
                       {{ request()->routeIs('admin.members.*')
                            ? 'text-blue-700 md:text-yellow-300'
                            : 'text-gray-900 md:text-white' }}">
                Users
            </a>
        </li>

        <li>
            <a href="{{ route('admin.profile.show') }}"
                class="block py-2 px-3 rounded
                       hover:bg-gray-100
                       md:hover:bg-transparent
                       md:border-0
                       md:text-white
                       md:hover:text-gray-200
                       md:p-0
                       {{ request()->routeIs('admin.profile.show')
                            ? 'text-blue-700 md:text-yellow-300'
                            : 'text-gray-900 md:text-white' }}">
                Profil
            </a>
        </li>
    @else
        <li>
            <a href="{{ route('anggota.dashboard') }}"
                class="block py-2 px-3 rounded
                       hover:bg-gray-100
                       md:hover:bg-transparent
                       md:border-0
                       md:text-white
                       md:hover:text-gray-200
                       md:p-0
                       {{ request()->routeIs('anggota.dashboard')
                            ? 'text-blue-700 md:text-yellow-300'
                            : 'text-gray-900 md:text-white' }}">
                Home
            </a>
        </li>

        <li>
            <a href="{{ route('anggota.contact') }}"
                class="block py-2 px-3 rounded
                       hover:bg-gray-100
                       md:hover:bg-transparent
                       md:border-0
                       md:text-white
                       md:hover:text-gray-200
                       md:p-0
                       {{ request()->routeIs('anggota.contact')
                            ? 'text-blue-700 md:text-yellow-300'
                            : 'text-gray-900 md:text-white' }}">
                Contact
            </a>
        </li>

        <li>
            <a href="{{ route('anggota.profile.show') }}"
                class="block py-2 px-3 rounded
                       hover:bg-gray-100
                       md:hover:bg-transparent
                       md:border-0
                       md:text-white
                       md:hover:text-gray-200
                       md:p-0
                       {{ request()->routeIs('anggota.profile.show')
                            ? 'text-blue-700 md:text-yellow-300'
                            : 'text-gray-900 md:text-white' }}">
                Profil
            </a>
        </li>
    @endif


                                    
                                    {{-- Tombol Logout (Mobile Only - dalam list) --}}
                                    <li class="md:hidden border-t border-gray-200 mt-2 pt-2">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left py-2 px-3 text-red-600 rounded hover:bg-gray-100">Logout</button>
                                        </form>
                                    </li>

                                    {{-- Tombol Logout (Desktop Only - terpisah dari list utama jika diinginkan, atau dalam list sebagai button) --}}
                                    <li class="hidden md:block ml-4">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 text-center">Logout</button>
                                        </form>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    @endunless
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
                        <a href="https://www.instagram.com/hmtiuntad/?utm_source=ig_web_button_share_sheet" class="text-gray-400 hover:text-white transition"><i class="fab fa-instagram"></i></a>
                    </div>
                    <div class="text-sm text-gray-200">
                        &copy; HMTI, 2025. All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
    </div>
    
    

    @yield('scripts')
</body>

</html>

