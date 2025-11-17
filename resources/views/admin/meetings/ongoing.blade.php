@extends('layouts.app')

@section('title', 'Rapat Sedang Berlangsung')

@section('container-class', 'max-w-5xl')

@section('content')
    <div class="mb-8 rounded-2xl bg-white p-8 space-y-6 border border-blue-300 shadow">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <div class="inline-flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-800 to-blue-500">
                        <i class="fas fa-play-circle text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900">Rapat Sedang Berlangsung</h1>
                        <p class="mt-1 text-sm text-slate-600">Pilih rapat untuk melanjutkan proses pemindaian</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-800 to-blue-500 px-4 py-2 text-sm font-medium text-white shadow-md hover:shadow-lg transition duration-200 hover:scale-105">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        {{-- [BARU] Notifikasi sukses --}}
        @if(session('success'))
            <div class="rounded-lg border border-green-300 bg-green-50 p-4">
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
        @endif
    </div>

    <div class="space-y-4">
        @forelse ($meetings as $meeting)
            {{-- [DIUBAH] Mengganti <a> dengan <div> dan menyesuaikan flex --}}
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between rounded-2xl bg-white p-6 shadow gap-4 transition duration-200 hover:shadow-lg">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">{{ $meeting->title }}</h2>
                    <p class="mt-2 text-sm text-slate-500"><i class="fas fa-clock mr-2"></i>{{ $meeting->time->format('d M Y H:i') }} &middot; <i class="fas fa-map-marker-alt mr-1"></i>{{ $meeting->location }}</p>
                </div>

                {{-- [BARU] Grup Tombol Aksi --}}
                <div class="flex-shrink-0 flex items-center gap-2 w-full sm:w-auto">
                    <a href="{{ route('admin.meetings.scan', $meeting) }}"
                       class="inline-flex w-full sm:w-auto items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-blue-800 to-blue-500 px-4 py-2 text-sm font-medium text-white">
                        Mulai Scan <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="{{ route('admin.meetings.edit', $meeting) }}" 
                       title="Edit"
                       class="inline-flex items-center justify-center rounded-lg border border-transparent bg-yellow-400 p-2 text-sm font-semibold text-yellow-900 hover:bg-yellow-500 transition-colors">
                       <i class="fas fa-edit w-4 h-4"></i>
                    </a>
                    <form action="{{ route('admin.meetings.destroy', $meeting) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus rapat ini? Semua data absensi terkait akan ikut terhapus.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                title="Hapus"
                                class="inline-flex items-center justify-center rounded-lg border border-transparent bg-red-500 p-2 text-sm font-semibold text-white hover:bg-red-600 transition-colors">
                            <i class="fas fa-trash w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="rounded-2xl bg-white p-6 text-center text-sm text-slate-500 shadow">
                <i class="fas fa-inbox text-3xl mb-3 opacity-50"></i>
                <p>Belum ada rapat yang berstatus ongoing.</p>
            </div>
        @endforelse
    </div>
@endsection