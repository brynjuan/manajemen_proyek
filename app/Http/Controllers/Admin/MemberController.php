<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

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
}
