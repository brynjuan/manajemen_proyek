@extends('layouts.app')

@section('title', 'Dashboard Anggota')

@section('container-class', 'max-w-7xl')

@section('content')
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-2">
        <div class="rounded-2xl bg-white p-6 shadow">
            <div class="text-sm font-medium text-slate-500">Total Kehadiran</div>
            <div class="mt-2 text-3xl font-semibold text-slate-900">{{ $attendanceCount ?? 0 }}</div>
        </div>

        <div class="rounded-2xl bg-white p-6 shadow">
            <div class="text-sm font-medium text-slate-500">Rapat Berlangsung</div>
            <div class="mt-2 text-3xl font-semibold text-slate-900">{{ $ongoingMeetingsCount ?? (isset($ongoingMeetings) ? $ongoingMeetings->count() : 0) }}</div>
        </div>
    </div>

    <div class="mt-10 grid gap-6 md:grid-cols-2">
        <a href="{{ route('anggota.qr') }}" class="flex items-center justify-between rounded-2xl bg-white px-6 py-5 text-black shadow transition duration-200 hover:scale-105">
            <div>
                <div class="text-lg font-semibold">QR Code Saya</div>
                <p class="mt-1 text-sm text-slate-500">Tampilkan QR code untuk proses absensi.</p>
            </div>
            <span class="text-3xl">&#128273;</span>
        </a>

        <a href="{{ route('anggota.history') }}" class="flex items-center justify-between rounded-2xl bg-white px-6 py-5 text-black shadow transition duration-200 hover:scale-105">
            <div>
                <div class="text-lg font-semibold text-slate-900">History Rapat</div>
                <p class="mt-1 text-sm text-slate-500">Lihat riwayat rapat yang pernah Anda ikuti.</p>
            </div>
            <span class="text-3xl text-slate-400">&#128214;</span>
        </a>
    </div>
@endsection

