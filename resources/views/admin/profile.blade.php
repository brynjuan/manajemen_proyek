@extends('layouts.app')

@section('title', 'Profil Admin')

@section('container-class', 'max-w-4xl')

@section('content')
    <div class="mb-8 rounded-2xl bg-white p-8 shadow space-y-6 p-8 border border-blue-300 shadow-sm">
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <div class="inline-flex items-center gap-3 mb-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-800 to-blue-500">
                        <i class="fas fa-user-circle text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-slate-900">Profil Admin</h1>
                        <p class="mt-1 text-sm text-slate-600">Kelola kredensial dan informasi akun administrator</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-800 to-blue-500 px-4 py-2 text-sm font-medium text-white shadow-md hover:shadow-lg transition duration-200 transform hover:scale-105">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.profile.update') }}"
        class="rounded-2xl bg-white p-8 shadow space-y-6">
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
                class="rounded-lg bg-gradient-to-r from-blue-800 to-blue-500 px-4 py-2 text-sm font-medium text-white shadow-md hover:shadow-lg transition duration-200 transform hover:scale-105">
                <i class="fas fa-save mr-2"></i>Update Profil
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="mt-6 inline-block">
            @csrf
            <button type="submit"
                class="rounded-lg border-2 border-red-200 px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50 transition duration-200">
                <i class="fas fa-sign-out-alt mr-2"></i>Logout
            </button>
        </form>
    </div>
@endsection

