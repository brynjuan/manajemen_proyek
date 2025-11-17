@extends('layouts.app')

@section('title', 'Profil Anggota')

@section('content')
    <div class="max-w-3xl space-y-6">
        <div class="rounded-2xl bg-white p-6 shadow">
            <h2 class="text-lg font-semibold text-slate-900">Data Anggota</h2>
            <dl class="mt-4 grid gap-4 text-sm text-slate-600 sm:grid-cols-2">
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Nama</dt>
                    <dd class="mt-1 text-slate-900">{{ $user->name }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">NIM</dt>
                    <dd class="mt-1 text-slate-900">{{ $user->nim }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Program Studi</dt>
                    <dd class="mt-1 text-slate-900">{{ $user->prodi }}</dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold uppercase tracking-wider text-slate-500">Tahun Angkatan</dt>
                    <dd class="mt-1 text-slate-900">{{ $user->tahun_angkatan }}</dd>
                </div>
            </dl>
        </div>

        <div class="rounded-2xl bg-white p-6 shadow">
            <h2 class="text-lg font-semibold text-slate-900">Pengaturan Akun</h2>
            <form method="POST" action="{{ route('anggota.profile.update') }}" class="mt-4 space-y-5">
                @csrf
                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700" for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-300" />
                </div>
                <div>
                    <label class="mb-1 block text-sm font-medium text-slate-700" for="password">Password Baru</label>
                    <input type="password" name="password" id="password"
                        class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm focus:border-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-300"
                        placeholder="Biarkan kosong jika tidak ingin mengubah" />
                </div>
                <button type="submit"
                    class="rounded-lg bg-slate-900 px-4 py-2 text-sm font-medium text-white hover:bg-slate-700">
                    Update Profil
                </button>
            </form>
        </div>

        <form method="POST" action="{{ route('logout') }}" class="inline-block">
            @csrf
            <button type="submit"
                class="rounded-lg border border-slate-100 px-4 py-2 text-sm font-medium text-slate-100 hover:bg-red-500">
                Logout
            </button>
        </form>
    </div>
@endsection

