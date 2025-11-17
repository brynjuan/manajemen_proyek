@extends('layouts.app')

@section('title', 'Detail Laporan Rapat')

@section('container-class', 'max-w-6xl')

@section('content')
    <div class="mb-8 rounded-2xl bg-white p-8 space-y-6 border border-blue-300 shadow">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <div class="inline-flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-800 to-blue-500">
                        <i class="fas fa-file-invoice text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900">{{ $meeting->title }}</h1>
                        <p class="mt-1 text-sm text-slate-600">Detail kehadiran rapat dan daftar peserta</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.reports.index') }}" class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-800 to-blue-500 px-4 py-2 text-sm font-medium text-white shadow-md hover:shadow-lg transition duration-200 hover:scale-105">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('admin.reports.pdf', $meeting) }}"
                    class="inline-flex items-center gap-2 rounded-lg bg-linear-to-r from-red-500 to-pink-600 px-4 py-2 text-sm font-medium text-white shadow-md hover:shadow-lg transition duration-200 transform hover:scale-105">
                    <i class="fas fa-file-pdf"></i> Download PDF
                </a>
            </div>
        </div>
    </div>

    <div class="rounded-2xl bg-white p-8 shadow mb-6">
        <div class="flex items-center gap-3 mb-6">
            <i class="fas fa-info-circle text-blue-600 text-lg"></i>
            <h2 class="text-xl font-semibold text-slate-900">Informasi Rapat</h2>
        </div>
        <dl class="grid gap-6 md:grid-cols-2">
            <div class="border-l-4 border-blue-800 pl-4">
                <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Waktu</dt>
                <dd class="mt-2 text-sm text-slate-900 font-medium"><i class="fas fa-clock mr-2"></i>{{ $meeting->time->format('d M Y H:i') }}</dd>
            </div>
            <div class="border-l-4 border-blue-700 pl-4">
                <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Lokasi</dt>
                <dd class="mt-2 text-sm text-slate-900 font-medium"><i class="fas fa-map-marker-alt mr-2"></i>{{ $meeting->location }}</dd>
            </div>
            <div class="md:col-span-2 border-l-4 border-blue-600 pl-4">
                <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Deskripsi</dt>
                <dd class="mt-2 text-sm text-slate-900 font-medium">{{ $meeting->description ?? '-' }}</dd>
            </div>
        </dl>
    </div>

    <div class="rounded-2xl bg-white shadow overflow-hidden">
        <div class="p-8 border-b border-slate-200">
            <div class="flex items-center gap-3">
                <i class="fas fa-users text-blue-600 text-lg"></i>
                <h2 class="text-xl font-semibold text-slate-900">Daftar Peserta ({{ count($meeting->attendees) }})</h2>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-white text-left text-xs font-semibold uppercase tracking-wider text-black">
                    <tr>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">NIM</th>
                        <th class="px-6 py-4">Prodi</th>
                        <th class="px-6 py-4">Tahun Angkatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                    @forelse ($meeting->attendees as $attendee)
                        <tr class="hover:bg-blue-50 transition duration-150 [&>td]:px-6 [&>td]:py-4 [&>td]:font-medium [&>td]:text-slate-900">
                            <td>{{ $attendee->name }}</td>
                            <td>{{ $attendee->nim }}</td>
                            <td>{{ $attendee->prodi }}</td>
                            <td>{{ $attendee->tahun_angkatan }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-sm text-slate-500">
                                <i class="fas fa-inbox text-3xl mb-3 opacity-50 block"></i>
                                <span>Belum ada anggota yang hadir.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

