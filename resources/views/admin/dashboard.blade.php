@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('container-class', 'max-w-7xl')

@section('content')
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

    <div class="mt-10 grid gap-6 md:grid-cols-2">
        <a href="{{ route('admin.members.create') }}"
            class="flex items-center justify-between rounded-2xl bg-white px-6 py-5 text-black shadow transition duration-200 hover:scale-105">
            <div>
                <div class="text-lg font-semibold">Tambah Anggota</div>
                <p class="mt-1 text-sm text-slate-500">Registrasi anggota baru dan generate QR code.</p>
            </div>
            <span class="text-3xl">+</span>
        </a>

        <a href="{{ route('admin.meetings.create') }}"
            class="flex items-center justify-between rounded-2xl bg-white px-6 py-5 text-black shadow transition duration-200 hover:scale-105">            <div>
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
@endsection

