

@extends('layouts.app')

@section('title', 'Edit Rapat')

@section('container-class', 'max-w-4xl')

@section('content')
    <div class="mb-8 rounded-2xl bg-white p-8 space-y-6 border border-blue-300 shadow">
        <div class="inline-flex items-center gap-3">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-yellow-500 to-yellow-300">
                <i class="fas fa-edit text-white text-lg"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Edit Rapat</h1>
                <p class="mt-1 text-sm text-slate-600">Perbarui detail untuk rapat: {{ $meeting->title }}</p>
            </div>
        </div>
    </div>

    <div class="rounded-2xl bg-white p-8 shadow">
        <form method="POST" action="{{ route('admin.meetings.update', $meeting) }}">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                {{-- Judul Rapat --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-slate-700">Judul Rapat</label>
                    <input type="text" id="title" name="title"
                           class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                           value="{{ old('title', $meeting->title) }}" required>
                    @error('title')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Waktu --}}
                <div>
                    <label for="time" class="block text-sm font-medium text-slate-700">Waktu</label>
                    <input type="datetime-local" id="time" name="time"
                           class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('time') border-red-500 @enderror"
                           value="{{ old('time', $meeting->time->format('Y-m-d\TH:i')) }}" required>
                    @error('time')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Lokasi --}}
                <div>
                    <label for="location" class="block text-sm font-medium text-slate-700">Lokasi</label>
                    <input type="text" id="location" name="location"
                           class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('location') border-red-500 @enderror"
                           value="{{ old('location', $meeting->location) }}" required>
                    @error('location')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700">Deskripsi (Opsional)</label>
                    <textarea id="description" name="description" rows="4"
                              class="mt-1 block w-full rounded-lg border-slate-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $meeting->description) }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4 border-t border-slate-200 pt-6">
                    <button type="submit"
                            class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-800 to-blue-500 px-4 py-2 text-sm font-medium text-white shadow-md hover:shadow-lg transition duration-200 transform hover:scale-105">
                        <i class="fas fa-save"></i> Update Rapat
                    </button>
                    <a href="{{ route('admin.meetings.ongoing') }}"
                       class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection