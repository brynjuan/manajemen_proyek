@extends('layouts.app')

@section('title', 'Detail Laporan Rapat')

@section('container-class', 'max-w-6xl')

@section('content')
    <div class="mb-8 rounded-2xl bg-white p-8 space-y-6 border border-blue-300 shadow">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <div class="inline-flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-800 to-blue-500">
                        <i class="fas fa-file-alt text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900">{{ $meeting->title }}</h1>
                        <p class="mt-1 text-sm text-slate-600">Detail kehadiran untuk rapat</p>
                    </div>
                </div>
            </div>
            <div class="flex-shrink-0 flex items-center gap-2">
                <a href="{{ route('admin.reports.index') }}"
                    class="inline-flex items-center gap-2 rounded-lg bg-slate-700 px-4 py-2 text-sm font-medium text-white shadow-md hover:shadow-lg transition duration-200">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('admin.reports.pdf', $meeting) }}" target="_blank"
                    class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-red-700 to-red-500 px-4 py-2 text-sm font-medium text-white shadow-md hover:shadow-lg transition duration-200">
                    <i class="fas fa-file-pdf"></i> Unduh PDF
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-sm text-slate-700">
            <div>
                <dt class="font-semibold text-slate-900"><i class="fas fa-clock mr-2 text-blue-500"></i>Waktu</dt>
                <dd class="mt-1">{{ $meeting->time->format('d M Y, H:i') }}</dd>
            </div>
            <div>
                <dt class="font-semibold text-slate-900"><i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>Lokasi</dt>
                <dd class="mt-1">{{ $meeting->location }}</dd>
            </div>
            <div>
                <dt class="font-semibold text-slate-900"><i class="fas fa-info-circle mr-2 text-blue-500"></i>Status</dt>
                <dd class="mt-1">
                    @if($meeting->status == 'ongoing')
                        <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-800">Sedang Berlangsung</span>
                    @else
                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">Selesai</span>
                    @endif
                </dd>
            </div>
        </div>
        @if($meeting->description)
            <div class="text-sm text-slate-700">
                <dt class="font-semibold text-slate-900"><i class="fas fa-align-left mr-2 text-blue-500"></i>Deskripsi</dt>
                <dd class="mt-1">{{ $meeting->description }}</dd>
            </div>
        @endif
        
        {{-- [BARU] Notifikasi Sukses / Error --}}
        @if(session('success'))
            <div class="rounded-lg border border-green-300 bg-green-50 p-4">
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
        @endif
        @if($errors->any())
            <div class="rounded-lg border border-red-300 bg-red-50 p-4">
                @foreach ($errors->all() as $error)
                    <p class="text-sm font-medium text-red-800">{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </div>

    {{-- [BARU] Formulir Tambah Anggota Manual --}}
    <div class="mb-6 rounded-2xl bg-white p-6 shadow">
        <h2 class="text-lg font-semibold text-slate-900 mb-4">Tambah Kehadiran Manual</h2>
        <form action="{{ route('admin.reports.attendances.add', $meeting) }}" method="POST" class="flex items-center gap-4">
            @csrf
            <div class="flex-grow">
                <label for="user_id" class="sr-only">Pilih Anggota</label>
                <select id="user_id" name="user_id"
                        class="block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">-- Pilih anggota yang akan ditambahkan --</option>
                    @foreach($members_not_attended as $member)
                        <option value="{{ $member->id }}">{{ $member->name }} ({{ $member->nim }})</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" 
                    class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-800 to-blue-500 px-4 py-2 text-sm font-medium text-white shadow-md hover:shadow-lg transition duration-200">
                <i class="fas fa-plus"></i> Tambah
            </button>
        </form>
        @if($members_not_attended->isEmpty())
            <p class="mt-3 text-sm text-slate-500">Semua anggota sudah terdaftar hadir.</p>
        @endif
    </div>

    {{-- Daftar Kehadiran --}}
    <div class="mt-6 overflow-hidden rounded-2xl bg-white shadow">
        <div class="border-b border-slate-200 bg-slate-50 px-6 py-4">
            <h2 class="text-xl font-semibold text-slate-900">Daftar Kehadiran</h2>
            <p class="mt-1 text-sm text-slate-600">Total: {{ $meeting->attendees->count() }} Anggota</p>
        </div>
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">NIM</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Waktu Hadir</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">Aksi</th> {{-- [BARU] Kolom Aksi --}}
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm text-slate-700">
                @forelse ($meeting->attendees as $attendee)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 font-medium text-slate-900">{{ $attendee->name }}</td>
                        <td class="px-6 py-4">{{ $attendee->nim }}</td>
                        {{-- [PERBAIKAN] Bungkus dengan \Carbon\Carbon::parse() --}}
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($attendee->pivot->attended_at)->format('d M Y, H:i:s') }}</td>
                        
                        {{-- [BARU] Tombol Hapus --}}
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('admin.reports.attendances.remove', [$meeting, $attendee]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $attendee->name }} dari daftar hadir?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="rounded-md bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-200">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-6 text-center text-sm text-slate-500">Belum ada anggota yang hadir.</td> {{-- [DIUBAH] Colspan 4 --}}
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection