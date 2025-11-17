@extends('layouts.app')

@section('title', 'Riwayat Rapat')

@section('container-class', 'max-w-5xl')

@section('content')
    <div class="mb-8 rounded-2xl bg-white p-8 space-y-6 border border-blue-300 shadow">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <div class="inline-flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-800 to-blue-500">
                        <i class="fas fa-file-pdf text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900">Riwayat Rapat</h1>
                        <p class="mt-1 text-sm text-slate-600">Lihat detail kehadiran setiap rapat dan unduh laporan PDF</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-800 to-blue-500 px-4 py-2 text-sm font-medium text-white shadow-md hover:shadow-lg transition duration-200 hover:scale-105">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="space-y-4">
        @forelse ($meetings as $meeting)
            <a href="{{ route('admin.reports.show', $meeting) }}"
                class="flex items-center justify-between rounded-2xl bg-white p-6 shadow transition duration-200 transform hover:shadow-lg hover:scale-105">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">{{ $meeting->title }}</h2>
                    <p class="mt-2 text-sm text-slate-500"><i class="fas fa-clock mr-2"></i>{{ $meeting->time->format('d M Y H:i') }} &middot; <i class="fas fa-map-marker-alt mr-1"></i>{{ $meeting->location }}</p>
                </div>
                <span class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-800 to-blue-500 px-4 py-2 text-sm font-medium text-white">
                    Lihat Detail <i class="fas fa-arrow-right"></i>
                </span>
            </a>
        @empty
            <div class="rounded-2xl bg-white p-6 text-center text-sm text-slate-500 shadow">
                <i class="fas fa-inbox text-3xl mb-3 opacity-50"></i>
                <p>Belum ada data rapat.</p>
            </div>
        @endforelse
    </div>
@endsection

