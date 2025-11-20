<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str; // Tambahkan jika perlu membuat qr_data manual

class MemberController extends Controller
{
    /**
     * Menampilkan daftar semua anggota.
     */
    public function index(Request $request): View
    {
        // Mulai query untuk user dengan role 'anggota'
        $query = User::where('role', 'anggota');

        // Filter Pencarian (Nama atau NIM)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nim', 'like', "%{$search}%");
            });
        }

        // Filter Program Studi
        if ($request->has('prodi') && $request->prodi != '') {
            $query->where('prodi', $request->prodi);
        }

        // Filter Tahun Angkatan
        if ($request->has('angkatan') && $request->angkatan != '') {
            $query->where('tahun_angkatan', $request->angkatan);
        }

        // Urutkan dan Paginate
        // Menggunakan append agar parameter pencarian tetap ada saat pindah halaman
        $members = $query->orderBy('name')->paginate(10)->withQueryString();

        // Ambil data unik untuk opsi filter dropdown
        $prodis = User::where('role', 'anggota')->distinct()->pluck('prodi')->filter()->sort();
        $angkatans = User::where('role', 'anggota')->distinct()->pluck('tahun_angkatan')->filter()->sortDesc();

        return view('admin.members.index', compact('members', 'prodis', 'angkatans'));
    }

    /**
     * Menampilkan form untuk membuat anggota baru.
     */
    public function create(): View
    {
        return view('admin.members.create');
    }

    /**
     * Menyimpan anggota baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:20', 'unique:users'],
            'prodi' => ['required', 'string', 'max:100'],
            'tahun_angkatan' => ['required', 'integer', 'min:2000'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        // Buat user baru
        User::create([
            'name' => $validated['name'],
            'nim' => $validated['nim'],
            'prodi' => $validated['prodi'],
            'tahun_angkatan' => $validated['tahun_angkatan'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'anggota',
            // Generate unique string untuk QR Data
            'qr_data' => (string) Str::uuid(), 
        ]);

        return redirect()->route('admin.members.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit anggota.
     */
    public function edit(User $member): View
    {
        return view('admin.members.edit', compact('member'));
    }

    /**
     * Memperbarui data anggota di database.
     */
    public function update(Request $request, User $member): RedirectResponse
    {
        // Validasi data
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($member->id)],
            'prodi' => ['required', 'string', 'max:100'],
            'tahun_angkatan' => ['required', 'integer', 'min:2000'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($member->id)],
            'password' => ['nullable', 'string', 'min:8'], // Password opsional
        ]);

        // Siapkan data untuk update
        $dataToUpdate = [
            'name' => $validated['name'],
            'nim' => $validated['nim'],
            'prodi' => $validated['prodi'],
            'tahun_angkatan' => $validated['tahun_angkatan'],
            'email' => $validated['email'],
        ];

        // Hanya update password jika diisi
        if (!empty($validated['password'])) {
            $dataToUpdate['password'] = Hash::make($validated['password']);
        }

        $member->update($dataToUpdate);

        return redirect()->route('admin.members.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    /**
     * Menghapus data anggota dari database.
     */
    public function destroy(User $member): RedirectResponse
    {
        // Hapus relasi absensi terlebih dahulu jika ada
        $member->attendances()->delete(); 
        
        // Hapus user
        $member->delete();

        return redirect()->route('admin.members.index')->with('success', 'Data anggota berhasil dihapus.');
    }
}
