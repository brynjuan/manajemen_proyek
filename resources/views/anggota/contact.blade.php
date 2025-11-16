@extends('layouts.app')

@section('title', 'Kontak HMTI')

@section('content')
    <div class="mx-auto max-w-2xl rounded-2xl bg-white p-8 shadow">
        <h1 class="text-2xl font-semibold text-slate-900">Kontak HMTI</h1>
        <p class="mt-2 text-sm text-slate-500">Silakan hubungi kami melalui informasi berikut.</p>

        <div class="mt-6 space-y-4 text-sm text-slate-600">
            <div>
                <div class="text-xs font-semibold uppercase tracking-wider text-slate-500">Email</div>
                <div class="mt-1 text-slate-900">sekretariat@hmti.ac.id</div>
            </div>
            <div>
                <div class="text-xs font-semibold uppercase tracking-wider text-slate-500">Telepon</div>
                <div class="mt-1 text-slate-900">(021) 1234-5678</div>
            </div>
            <div>
                <div class="text-xs font-semibold uppercase tracking-wider text-slate-500">Alamat</div>
                <div class="mt-1 text-slate-900">Gedung Teknologi Informasi Lt. 2, Kampus HMTI</div>
            </div>
        </div>
    </div>
@endsection

