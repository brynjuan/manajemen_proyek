<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    public function index(): View
    {
        $members = User::where('role', 'anggota')->orderBy('nim')->paginate(10);

        return view('admin.members.index', compact('members'));
    }

    public function create(): View
    {
        return view('admin.members.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:50', 'unique:users,nim'],
            'prodi' => ['required', 'string', 'max:255'],
            'tahun_angkatan' => ['required', 'string', 'max:10'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        User::create([
            'name' => $validated['name'],
            'nim' => $validated['nim'],
            'prodi' => $validated['prodi'],
            'tahun_angkatan' => $validated['tahun_angkatan'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'anggota',
            'qr_data' => Str::uuid()->toString(),
        ]);

        return redirect()
            ->route('admin.members.create')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function edit(User $member): View
    {
        // $member akan otomatis di-resolve oleh Laravel berdasarkan {member} di URL
        return view('admin.members.edit', compact('member'));
    }

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
        
        // Jika Anda ingin mengizinkan perubahan 'qr_data', tambahkan validasi dan field-nya di sini
        // 'qr_data' => ['required', 'string', Rule::unique('users')->ignore($member->id)],

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
