@extends('layouts.app')

@section('title', 'Dashboard Admin')

{{-- [DIUBAH] Menggunakan container-class dari file Anda --}}
@section('container-class', 'max-w-7xl')

@section('content')
    {{-- [DARI ANDA] Bagian Kartu Statistik --}}
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-2xl bg-white p-6 shadow">
            <div class="text-sm font-medium text-slate-500">Total Anggota</div>
            <div class="mt-2 text-3xl font-semibold text-slate-900">{{ $totalMembers }}</div>
        </div>
        <div class="rounded-2xl bg-white p-6 shadow">
            <div class="text-sm font-medium text-slate-500">Rapat Berlangsung</div>
            <div class="mt-2 text-3xl font-semibold text-slate-900">{{ $ongoingMeetings }}</div>
        </div>
        <div class="rounded-2xl bg-white p-6 shadow">
            <div class="text-sm font-medium text-slate-500">Rapat Selesai</div>
            <div class="mt-2 text-3xl font-semibold text-slate-900">{{ $finishedMeetings }}</div>
        </div>
        <div class="rounded-2xl bg-white p-6 shadow">
            <div class="text-sm font-medium text-slate-500">Tanggal Hari Ini</div>
            <div class="mt-2 text-3xl font-semibold text-slate-900">{{ now()->translatedFormat('d M Y') }}</div>
        </div>
    </div>

    {{-- [DARI ANDA] Bagian Menu Tautan --}}
    <div class="mt-10 grid gap-6 md:grid-cols-2">
        <a href="{{ route('admin.members.create') }}"
            class="flex items-center justify-between rounded-2xl bg-white px-6 py-5 text-black shadow transition duration-200 hover:scale-105">
            <div>
                <div class="text-lg font-semibold">Tambah Anggota</div>
                <p class="mt-1 text-sm text-slate-500">Registrasi anggota baru dan generate QR code.</p>
            </div>
            <span class="text-3xl">+</span>
        </a>

        {{-- [PERBAIKAN] Spasi kosong yang tidak disengaja dihapus dari baris di bawah --}}
        <a href="{{ route('admin.meetings.create') }}"
            class="flex items-center justify-between rounded-2xl bg-white px-6 py-5 text-black shadow transition duration-200 hover:scale-105"><div>
                <div class="text-lg font-semibold text-slate-900">Buat Rapat</div>
                <p class="mt-1 text-sm text-slate-500">Jadwalkan rapat baru dan mulai absensi.</p>
            </div>
            <span class="text-3xl text-slate-400">&#128197;</span>
        </a>

        <a href="{{ route('admin.meetings.ongoing') }}"
            class="flex items-center justify-between rounded-2xl bg-white px-6 py-5 text-black shadow transition duration-200 hover:scale-105">
            <div>
                <div class="text-lg font-semibold text-slate-900">Rapat Sedang Berlangsung</div>
                <p class="mt-1 text-sm text-slate-500">Lihat daftar rapat aktif dan lanjutkan pemindaian.</p>
            </div>
            <span class="text-3xl text-slate-400">&#9201;</span>
        </a>

        <a href="{{ route('admin.reports.index') }}"
            class="flex items-center justify-between rounded-2xl bg-white px-6 py-5 text-black shadow transition duration-200 hover:scale-105">
            <div>
                <div class="text-lg font-semibold text-slate-900">Download Data</div>
                <p class="mt-1 text-sm text-slate-500">Akses riwayat rapat dan ekspor ke PDF.</p>
            </div>
            <span class="text-3xl text-slate-400">&#128190;</span>
        </a>
    </div>

    {{-- [BARU DITAMBAHKAN] Grafik Kehadiran --}}
    <div class="mt-10 rounded-2xl bg-white p-8 shadow">
        <h2 class="text-2xl font-bold text-slate-900 mb-6">Tren Kehadiran Rapat (10 Rapat Terakhir)</h2>
        @if($chartLabels->isEmpty())
             <div class="rounded-2xl bg-slate-50 p-6 text-center text-sm text-slate-500 shadow-inner">
                <i class="fas fa-inbox text-3xl mb-3 opacity-50"></i>
                <p>Belum ada data rapat yang selesai untuk ditampilkan di grafik.</p>
            </div>
        @else
            <div>
                <canvas id="attendanceChart" style="width: 100%; height: 400px;"></canvas>
            </div>
        @endif
    </div>

@endsection

@section('scripts')
    {{-- [BARU DITAMBAHKAN] Skrip untuk Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Ambil data dari PHP
            const labels = @json($chartLabels);
            const data = @json($chartData);

            if (labels.length > 0) {
                const ctx = document.getElementById('attendanceChart').getContext('2d');
                
                // Buat gradien untuk bar
                const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, 'rgba(30, 64, 175, 0.8)'); // blue-800
                gradient.addColorStop(1, 'rgba(37, 99, 235, 0.5)'); // blue-500

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Kehadiran',
                            data: data,
                            backgroundColor: gradient,
                            borderColor: 'rgba(30, 64, 175, 1)',
                            borderWidth: 2,
                            borderRadius: 8,
                            hoverBackgroundColor: 'rgba(30, 64, 175, 1)'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false // Sembunyikan legenda
                            },
                            tooltip: {
                                displayColors: false,
                                padding: 10,
                                titleFont: { size: 14, weight: 'bold' },
                                bodyFont: { size: 12 },
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    drawBorder: false,
                                    color: '#E2E8F0' // slate-200
                                },
                                ticks: {
                                    color: '#64748B', // slate-500
                                    // Pastikan hanya angka bulat (integer) di sumbu Y
                                    callback: function(value) {
                                        if (value % 1 === 0) {
                                            return value;
                                        }
                                    }
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    color: '#64748B' // slate-500
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
@endsection