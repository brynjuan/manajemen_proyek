@extends('layouts.app')

@section('title', 'Buat Rapat Baru')

@section('container-class', 'max-w-4xl')

@section('content')
    <div class="mb-8 rounded-2xl bg-white p-8 space-y-6 border border-blue-300 shadow">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <div class="inline-flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-800 to-blue-500">
                        <i class="fas fa-calendar-plus text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900">Buat Rapat Baru</h1>
                        <p class="mt-1 text-sm text-slate-600">Isi informasi rapat untuk memulai sesi absensi</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-800 to-blue-500 px-4 py-2 text-sm font-medium text-white shadow-md hover:shadow-lg transition duration-200 hover:scale-105">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.meetings.store') }}" class="rounded-2xl bg-white p-8 shadow space-y-6">
        @csrf
        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700" for="title">Judul Rapat</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-300" />
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700" for="time">Waktu</label>
            <input type="datetime-local" name="time" id="time" value="{{ old('time') }}" required
                class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-300" />
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700" for="location">Lokasi</label>
            <input type="text" name="location" id="location" value="{{ old('location') }}" required
                class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-300" />
        </div>
        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700" for="description">Deskripsi</label>
            <textarea name="description" id="description" rows="4"
                class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-300">{{ old('description') }}</textarea>
        </div>
        <button type="submit"
            class="w-full rounded-lg bg-gradient-to-r from-blue-800 to-blue-500 px-4 py-2 text-sm font-medium text-white shadow-md hover:shadow-lg transition duration-200 hover:scale-105">
            <i class="fas fa-check mr-2"></i>Simpan dan Mulai Scan
        </button>
    </form>
@endsection

