@extends('layouts.app')

@section('title', 'Scan Absensi')

@section('container-class', 'max-w-6xl')

@section('content')
    <div class="mb-8 rounded-2xl bg-white p-8 space-y-6 border border-blue-300 shadow">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <div class="inline-flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-800 to-blue-500">
                        <i class="fas fa-qrcode text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900">Scan Absensi</h1>
                        <p class="mt-1 text-sm text-slate-600">Gunakan kamera untuk memindai QR code anggota</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.meetings.ongoing') }}" class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-800 to-blue-500 px-4 py-2 text-sm font-medium text-white shadow-md hover:shadow-lg transition duration-200 hover:scale-105">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <form method="POST" action="{{ route('admin.meetings.finish', $meeting) }}">
                    @csrf
                    <button type="submit"
                        class="inline-flex items-center gap-2 rounded-lg bg-linear-to-r from-red-500 to-pink-600 px-4 py-2 text-sm font-medium text-white shadow-md hover:shadow-lg transition duration-200">
                        <i class="fas fa-stop-circle"></i> Akhiri Rapat
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-2xl bg-white p-6 shadow">
            <div class="flex items-center gap-3 mb-4">
                <i class="fas fa-info-circle text-blue-600 text-lg"></i>
                <h2 class="text-xl font-semibold text-slate-900">Detail Rapat</h2>
            </div>
            <dl class="mt-4 space-y-3 text-sm text-slate-600">
                <div class="border-l-4 border-blue-800 pl-4">
                    <dt class="font-medium text-slate-500">Judul</dt>
                    <dd class="text-slate-900 font-medium">{{ $meeting->title }}</dd>
                </div>
                <div class="border-l-4 border-blue-700 pl-4">
                    <dt class="font-medium text-slate-500">Waktu</dt>
                    <dd class="text-slate-900 font-medium"><i class="fas fa-clock mr-2"></i>{{ $meeting->time->format('d M Y H:i') }}</dd>
                </div>
                <div class="border-l-4 border-blue-600 pl-4">
                    <dt class="font-medium text-slate-500">Lokasi</dt>
                    <dd class="text-slate-900 font-medium"><i class="fas fa-map-marker-alt mr-2"></i>{{ $meeting->location }}</dd>
                </div>
                <div class="border-l-4 border-blue-500 pl-4">
                    <dt class="font-medium text-slate-500">Deskripsi</dt>
                    <dd class="text-slate-900 font-medium">{{ $meeting->description ?? '-' }}</dd>
                </div>
            </dl>
        </div>

        <div class="rounded-2xl bg-white p-6 shadow">
            <div class="flex items-center gap-3 mb-4">
                <i class="fas fa-video text-blue-600 text-lg"></i>
                <h2 class="text-xl font-semibold text-slate-900">Scanner QR Code</h2>
            </div>
            <div id="scan-message" class="hidden rounded-lg px-4 py-3 text-sm"></div>
            <div id="qr-reader" class="mt-4 overflow-hidden rounded-xl border-2 border-blue-200"></div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/scan.js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.renderMeetingScanner) {
                window.renderMeetingScanner({
                    elementId: 'qr-reader',
                    endpoint: '{{ route('admin.meetings.scan.store', $meeting) }}',
                    messageContainerId: 'scan-message'
                });
            }
        });
    </script>
@endsection

