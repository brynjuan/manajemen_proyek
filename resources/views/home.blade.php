<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Home</title>
    {{-- Memuat CSS dari Vite --}}
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">

    {{-- Contoh Navbar --}}
    <nav class="bg-white shadow-md p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-green-600">Proyek Saya</h1>
        <div>
            <a href="{{ url('home') }}" class="text-green-600 font-bold hover:text-green-800 mx-2">Home</a>
            <a href="{{ url('dashboard') }}" class="text-gray-600 hover:text-green-600 mx-2">Dashboard</a>
            {{-- Tambahkan link lain jika perlu --}}
        </div>
    </nav>

    {{-- Konten Utama Halaman Home --}}
    <main class="container mx-auto p-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Selamat Datang di Halaman Home</h2>

        <div class="bg-white p-6 rounded-lg shadow">
            <p class="text-gray-600">
                Ini adalah konten dasar untuk halaman home Anda. Anda bisa mengganti teks ini dengan konten yang Anda inginkan.
            </p>
            {{-- Tambahkan elemen lain di sini --}}
        </div>
    </main>

    {{-- Footer jika diperlukan --}}
    {{-- <footer class="bg-white shadow-md p-4 mt-8 text-center text-gray-600">
        Hak Cipta © {{ date('Y') }} Proyek Saya
    </footer> --}}

    {{-- Memuat JS dari Vite jika perlu --}}
    {{-- @vite('resources/js/app.js') --}}
</body>
</html>