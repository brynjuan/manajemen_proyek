@extends('layouts.app')

@section('title', 'Dashboard Anggota')

@section('container-class', 'max-w-5xl')

@section('content')
    {{-- Header Section --}}
    <div class="mb-8 rounded-2xl bg-white p-6 sm:p-8 shadow-sm border border-blue-100">
        <div class="flex items-center gap-4">
            <div class="flex h-14 w-14 sm:h-16 sm:w-16 flex-shrink-0 items-center justify-center rounded-full bg-blue-50 text-blue-600">
                <i class="fas fa-user-circle text-3xl sm:text-4xl"></i>
            </div>
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900">Halo, {{ Auth::user()->name }}!</h1>
                <p class="text-slate-600 text-sm sm:text-base">Selamat datang di sistem absensi HMTI.</p>
            </div>
        </div>
    </div>

    {{-- Stats & Quick Action --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Stat Card: Kehadiran --}}
        <div class="rounded-2xl bg-white p-6 shadow-sm border-l-4 border-blue-500 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500">Total Kehadiran</p>
                <p class="text-3xl font-bold text-slate-900 mt-1">{{ $attendanceCount }}</p>
            </div>
            <div class="h-12 w-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                <i class="fas fa-calendar-check text-xl"></i>
            </div>
        </div>
        
        {{-- Quick Action: Lihat QR Code --}}
        <a href="{{ route('anggota.qr') }}" class="md:col-span-2 group relative overflow-hidden rounded-2xl bg-gradient-to-r from-blue-600 to-blue-500 p-6 shadow-md text-white transition hover:shadow-lg hover:-translate-y-0.5">
            <div class="relative z-10 flex items-center justify-between h-full">
                <div>
                    <h3 class="text-lg font-bold">Identitas Absensi</h3>
                    <p class="text-blue-100 text-sm mt-1">Klik di sini untuk menampilkan QR Code Anda saat absensi rapat.</p>
                </div>
                <div class="h-12 w-12 rounded-full bg-white/20 flex items-center justify-center backdrop-blur-sm group-hover:bg-white/30 transition">
                    <i class="fas fa-qrcode text-2xl"></i>
                </div>
            </div>
            {{-- Decorative Circle --}}
            <div class="absolute -right-6 -bottom-6 h-32 w-32 rounded-full bg-white/10"></div>
        </a>
    </div>

    {{-- Section: Rapat Berlangsung --}}
<div class="mt-8">
    <div class="flex items-center justify-between mb-5">
        <h2 class="text-xl font-bold text-white flex items-center gap-2">
            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-yellow-100 text-yellow-600 shadow-sm">
                <i class="fas fa-bell animate-swing"></i>
            </span>
            Rapat Sedang Berlangsung
        </h2>
    </div>


        @if($ongoingMeetings->count() > 0)
            <div class="grid grid-cols-1 gap-6">
                @foreach($ongoingMeetings as $meeting)
                    <div class="rounded-2xl bg-white border border-slate-200 shadow-sm hover:shadow-md transition overflow-hidden">
                        <div class="p-6">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6">
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center gap-3 mb-3">
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-700 border border-green-200">
                                            <span class="relative flex h-2 w-2">
                                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                              <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                            </span>
                                            Ongoing
                                        </span>
                                        <span class="text-sm text-slate-500 font-medium flex items-center">
                                            <i class="far fa-calendar-alt mr-1.5"></i> {{ $meeting->time->format('l, d F Y') }}
                                        </span>
                                    </div>
                                    
                                    <h3 class="text-xl font-bold text-slate-900 mb-2">{{ $meeting->title }}</h3>
                                    
                                    @if($meeting->description)
                                        <p class="text-slate-600 mb-4 text-sm leading-relaxed">{{ $meeting->description }}</p>
                                    @endif
                                    
                                    <div class="flex flex-wrap items-center gap-4 text-sm text-slate-600 mt-4 pt-4 border-t border-slate-100">
                                        <div class="flex items-center gap-2 bg-slate-50 px-3 py-1.5 rounded-lg">
                                            <i class="far fa-clock text-blue-500"></i>
                                            <span class="font-medium">{{ $meeting->time->format('H:i') }} WITA</span>
                                        </div>
                                        <div class="flex items-center gap-2 bg-slate-50 px-3 py-1.5 rounded-lg">
                                            <i class="fas fa-map-marker-alt text-red-500"></i>
                                            <span class="font-medium">{{ $meeting->location }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 bg-slate-50 px-3 py-1.5 rounded-lg">
                                            <i class="fas fa-users text-purple-500"></i>
                                            <span class="font-medium">{{ $meeting->attendances_count }} Peserta</span>
                                        </div>
                                    </div>
                                </div>
                                
                                {{-- Action Button --}}
                                <div class="flex-shrink-0 flex flex-col items-end justify-center gap-2 w-full md:w-auto">
                                    <a href="{{ route('anggota.qr') }}" class="inline-flex w-full md:w-auto items-center justify-center px-5 py-2.5 bg-slate-900 text-white text-sm font-medium rounded-xl hover:bg-slate-800 transition shadow-lg shadow-slate-900/20">
                                        <i class="fas fa-qrcode mr-2"></i> Absen Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="rounded-2xl bg-slate-50 p-10 text-center border-2 border-dashed border-slate-200">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-white shadow-sm mb-4">
                    <i class="fas fa-mug-hot text-slate-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-semibold text-slate-900">Tidak ada rapat aktif</h3>
                <p class="mt-2 text-slate-500 max-w-sm mx-auto">Saat ini belum ada rapat yang sedang berlangsung. Silakan cek kembali nanti.</p>
            </div>
        @endif
    </div>
@endsection