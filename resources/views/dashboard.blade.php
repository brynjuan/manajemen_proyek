<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Sederhana</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">

    <!-- Navbar -->
    <nav class="bg-white shadow-md p-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-green-600">My Dashboard</h1>
        <div>
            <a href="/home" class="text-gray-600 hover:text-green-600 mx-2">Home</a>
            <a href="#" class="text-gray-600 hover:text-green-600 mx-2">Profile</a>
            <a href="#" class="text-gray-600 hover:text-green-600 mx-2">Logout</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex">

        <!-- Sidebar -->
        <aside class="w-64 bg-white h-screen shadow-md hidden md:block">
            <ul class="mt-6">
                <li class="p-4 hover:bg-green-100 cursor-pointer">📊 Dashboard</li>
                <li class="p-4 hover:bg-green-100 cursor-pointer">🗂️ Data</li>
                <li class="p-4 hover:bg-green-100 cursor-pointer">📅 Jadwal</li>
                <li class="p-4 hover:bg-green-100 cursor-pointer">⚙️ Pengaturan</li>
            </ul>
        </aside>

        <!-- Dashboard Content -->
        <main class="flex-1 p-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Selamat Datang di Dashboard</h2>

            <!-- Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="text-lg font-bold text-green-600 mb-2">Data Pengguna</h3>
                    <p class="text-gray-600 text-sm">Jumlah pengguna aktif saat ini: <b>120</b></p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="text-lg font-bold text-green-600 mb-2">Total Transaksi</h3>
                    <p class="text-gray-600 text-sm">Transaksi bulan ini: <b>340</b></p>
                </div>

                <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg transition">
                    <h3 class="text-lg font-bold text-green-600 mb-2">Laporan</h3>
                    <p class="text-gray-600 text-sm">Laporan baru telah tersedia.</p>
                </div>
            </div>

            <!-- Table Section -->
            <div class="mt-8 bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-bold text-gray-700 mb-4">Data Terbaru</h3>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-green-100 text-green-700">
                            <th class="p-3 border-b">#</th>
                            <th class="p-3 border-b">Nama</th>
                            <th class="p-3 border-b">Tanggal</th>
                            <th class="p-3 border-b">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border-b">1</td>
                            <td class="p-3 border-b">Fahril</td>
                            <td class="p-3 border-b">29 Okt 2025</td>
                            <td class="p-3 border-b text-green-600 font-semibold">Aktif</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border-b">2</td>
                            <td class="p-3 border-b">Niranjan</td>
                            <td class="p-3 border-b">28 Okt 2025</td>
                            <td class="p-3 border-b text-yellow-600 font-semibold">Pending</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
