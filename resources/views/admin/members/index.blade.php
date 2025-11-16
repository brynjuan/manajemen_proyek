@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('container-class', 'max-w-6xl')

@section('content')
    <div class="mb-8 rounded-2xl bg-white p-8 shadow space-y-6 p-8 border border-blue-300 shadow-sm">
        <div class="flex items-start justify-between">
            <div class="flex-1">
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-sm text-slate-500">Belum ada anggota.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $members->links() }}
    </div>
@endsection

