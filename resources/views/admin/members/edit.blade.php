@extends('layouts.app')

@section('title', 'Edit Anggota')

@section('container-class', 'max-w-4xl')

@section('content')
    <div class="mb-8 rounded-2xl bg-white p-8 shadow space-y-6 p-8 border border-blue-300 shadow-sm">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <div class="inline-flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-yellow-500 to-yellow-300">
                        <i class="fas fa-user-edit text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900">Edit Anggota</h1>
                        <p class="mt-1 text-sm text-slate-600">Perbarui data untuk {{ $member->name }}</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.members.index') }}" class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-800 to-blue-500 px-4 py-2 text-sm font-medium text-white shadow-md hover:shadow-lg transition duration-200 transform hover:scale-105">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.members.update', $member) }}" class="mt-6 grid gap-5 rounded-2xl bg-white p-8 shadow md:grid-cols-2">
        @csrf
        @method('PUT') {{-- PENTING: Gunakan metode PUT untuk update --}}

        {{-- Nama --}}
        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700" for="name">Nama Lengkap</label>
            <input type="text" name="name" id="name" value="{{ old('name', $member->name) }}" required
                   class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-300 @error('name') border-red-500 @enderror" />
            @error('name')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- NIM --}}
        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700" for="nim">NIM</label>
            <input type="text" name="nim" id="nim" value="{{ old('nim', $member->nim) }}" required
                   class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-300 @error('nim') border-red-500 @enderror" />
            @error('nim')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Prodi (Dropdown) --}}
        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700" for="prodi">Program Studi</label>
            <select name="prodi" id="prodi" required
                    class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-300 @error('prodi') border-red-500 @enderror">
                <option value="">-- Pilih Program Studi --</option>
                <option value="Teknik Informatika" {{ old('prodi', $member->prodi) == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                <option value="Sistem Informasi" {{ old('prodi', $member->prodi) == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
            </select>
            @error('prodi')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tahun Angkatan (Dropdown) --}}
        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700" for="tahun_angkatan">Tahun Angkatan</label>
            <select name="tahun_angkatan" id="tahun_angkatan" required
                    class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-300 @error('tahun_angkatan') border-red-500 @enderror">
                <option value="">-- Pilih Tahun Angkatan --</option>
                @for ($year = 2020; $year <= 2025; $year++)
                    <option value="{{ $year }}" {{ old('tahun_angkatan', $member->tahun_angkatan) == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endfor
            </select>
            @error('tahun_angkatan')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700" for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $member->email) }}" required
                   class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-300 @error('email') border-red-500 @enderror" />
            @error('email')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700" for="password">Password Baru</label>
            <input type="password" name="password" id="password"
                   class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-300 @error('password') border-red-500 @enderror" />
            <p class="mt-1 text-xs text-slate-500">Kosongkan jika tidak ingin mengubah password.</p>
            @error('password')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="md:col-span-2">
            <button type="submit"
                    class="w-full rounded-lg bg-gradient-to-r from-blue-800 to-blue-500 px-4 py-2 text-sm font-medium text-white shadow-md hover:shadow-lg transition duration-200 hover:scale-105">
                Update Anggota
            </button>
        </div>
    </form>
@endsection