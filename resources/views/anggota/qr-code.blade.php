@extends('layouts.app')

@section('title', 'QR Code Saya')

@section('content')
    <div class="mx-auto max-w-xl rounded-2xl bg-white p-8 text-center shadow">
        <h1 class="text-2xl font-semibold text-slate-900">QR Code Saya</h1>
        <p class="mt-2 text-sm text-slate-500">Tunjukkan QR code ini kepada admin saat proses absensi.</p>

        <div class="mt-6 inline-block rounded-2xl border border-slate-200 bg-slate-50 p-6">
            {!! QrCode::size(220)->style('square')->generate($user->qr_data ?? 'Data QR belum tersedia') !!}
        </div>

        <div class="mt-4 text-sm text-slate-500">
            <div><strong>Nama:</strong> {{ $user->name }}</div>
            <div><strong>NIM:</strong> {{ $user->nim }}</div>
            <div><strong>Prodi:</strong> {{ $user->prodi }}</div>
        </div>
    </div>
@endsection

