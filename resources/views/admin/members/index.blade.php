@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('container-class', 'max-w-6xl')

@section('content')
    <div class="mb-8 rounded-2xl bg-white p-8 shadow space-y-6 p-8 border border-blue-300 shadow-sm">
        <div class="flex items-start justify-between flex-wrap gap-4">
            <div class="flex-1 min-w-[200px]">
                <div class="inline-flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-800 to-blue-500">
                        <i class="fas fa-users text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900">Daftar Anggota</h1>
                        <p class="mt-1 text-sm text-slate-600">Kelola semua anggota yang terdaftar di sistem</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.members.create') }}"
                class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-800 to-blue-500 px-4 py-2 text-sm font-medium text-white shadow-md hover:shadow-lg transition duration-200 transform hover:scale-105">
                <i class="fas fa-plus"></i> Tambah Anggota
            </a>
        </div>
        
        {{-- Tampilkan notifikasi sukses --}}
        @if(session('success'))
            <div class="rounded-lg border border-green-300 bg-green-50 p-4">
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
        @endif

        {{-- [BARU] Form Pencarian dan Filter --}}
        <form method="GET" action="{{ route('admin.members.index') }}" class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-4">
            {{-- Search Input --}}
            <div class="md:col-span-2">
                <label for="search" class="sr-only">Cari Nama atau NIM</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-search text-slate-400"></i>
                    </div>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        class="block w-full rounded-lg border border-slate-300 bg-slate-50 p-2.5 pl-10 text-sm text-slate-900 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Cari Nama atau NIM...">
                </div>
            </div>

            {{-- Filter Prodi --}}
            <div>
                <label for="prodi" class="sr-only">Filter Prodi</label>
                <select name="prodi" id="prodi"
                    class="block w-full rounded-lg border border-slate-300 bg-slate-50 p-2.5 text-sm text-slate-900 focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Semua Prodi</option>
                    @foreach($prodis as $p)
                        <option value="{{ $p }}" {{ request('prodi') == $p ? 'selected' : '' }}>{{ $p }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Filter Angkatan & Tombol Submit --}}
            <div class="flex gap-2">
                <div class="flex-grow">
                    <label for="angkatan" class="sr-only">Filter Angkatan</label>
                    <select name="angkatan" id="angkatan"
                        class="block w-full rounded-lg border border-slate-300 bg-slate-50 p-2.5 text-sm text-slate-900 focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Semua Angkatan</option>
                        @foreach($angkatans as $a)
                            <option value="{{ $a }}" {{ request('angkatan') == $a ? 'selected' : '' }}>{{ $a }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="rounded-lg bg-blue-700 px-4 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">
                    Filter
                </button>
                 @if(request()->hasAny(['search', 'prodi', 'angkatan']))
                    <a href="{{ route('admin.members.index') }}" class="flex items-center justify-center rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-700 hover:bg-slate-100" title="Reset Filter">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="mt-6 overflow-hidden rounded-2xl bg-white shadow">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">NIM</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Prodi</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Tahun</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Email</th>
                    <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                @forelse ($members as $member)
                    <tr class="hover:bg-slate-50">
                        <td class="px-4 py-3 font-medium text-slate-900">{{ $member->name }}</td>
                        <td class="px-4 py-3">{{ $member->nim }}</td>
                        <td class="px-4 py-3">{{ $member->prodi }}</td>
                        <td class="px-4 py-3">{{ $member->tahun_angkatan }}</td>
                        <td class="px-4 py-3">{{ $member->email }}</td>

                        {{-- Tombol Edit & Delete --}}
                        <td class="px-4 py-3 text-right space-x-2 whitespace-nowrap">
                            <a href="{{ route('admin.members.edit', $member) }}" 
                               class="inline-flex items-center justify-center rounded-md border border-transparent bg-yellow-400 px-3 py-1.5 text-xs font-semibold text-yellow-900 hover:bg-yellow-500 transition-colors">
                               Edit
                            </a>
                            <form action="{{ route('admin.members.destroy', $member) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center justify-center rounded-md border border-transparent bg-red-500 px-3 py-1.5 text-xs font-semibold text-white hover:bg-red-600 transition-colors">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-sm text-slate-500">
                            @if(request()->hasAny(['search', 'prodi', 'angkatan']))
                                Tidak ada anggota yang cocok dengan filter pencarian.
                            @else
                                Belum ada anggota.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{-- Pastikan pagination link tetap membawa query params (search/filter) --}}
        {{ $members->links() }}
    </div>
@endsection