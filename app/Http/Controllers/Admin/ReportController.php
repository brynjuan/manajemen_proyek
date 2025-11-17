<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Models\User; // <-- [BARU] Tambahkan ini
use App\Models\Attendance; 
use Illuminate\Http\Request; // <-- [BARU] Tambahkan ini
use Illuminate\Http\RedirectResponse; // <-- [BARU] Tambahkan ini

class ReportController extends Controller
{
    public function index(): View
    {
        $meetings = Meeting::orderByDesc('time')->get();

        return view('admin.reports.index', compact('meetings'));
    }

    public function show(Meeting $meeting): View
    {
        // [MODIFIKASI] Muat data attendees
        $meeting->load(['attendees' => function ($query) {
            $query->orderBy('users.nim');
        }]);

        // [BARU] Ambil ID semua anggota
        $all_member_ids = User::where('role', 'anggota')->pluck('id');
        // Ambil ID anggota yang sudah hadir di rapat ini
        $attended_member_ids = $meeting->attendees->pluck('id');

        // Ambil data anggota yang BELUM hadir
        $members_not_attended = User::whereIn('id', $all_member_ids)
                                      ->whereNotIn('id', $attended_member_ids)
                                      ->orderBy('name')
                                      ->get();

        return view('admin.reports.show', compact('meeting', 'members_not_attended'));
    }
    public function download(Meeting $meeting): Response
    {
        $meeting->load(['attendees' => function ($query) {
            $query->orderBy('users.nim');
        }]);

        $pdf = Pdf::loadView('admin.reports.pdf', [
            'meeting' => $meeting,
            'attendees' => $meeting->attendees,
        ]);

        return $pdf->stream('laporan-rapat-'.$meeting->id.'.pdf');
    }

   // --- [BARU] Metode untuk menambah absensi manual ---
    public function addAttendance(Request $request, Meeting $meeting): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
        ]);

        // Cek agar tidak duplikat
        $is_attended = Attendance::where('meeting_id', $meeting->id)
                                ->where('user_id', $validated['user_id'])
                                ->exists();

        if ($is_attended) {
            return back()->withErrors('Anggota tersebut sudah terdaftar hadir.');
        }

        // Tambahkan absensi
        Attendance::create([
            'meeting_id' => $meeting->id,
            'user_id' => $validated['user_id'],
            'attended_at' => now(), // Set waktu hadir ke "sekarang"
        ]);

        return back()->with('success', 'Anggota berhasil ditambahkan.');
    }

    // --- [BARU] Metode untuk menghapus absensi ---
    public function removeAttendance(Meeting $meeting, User $user): RedirectResponse
    {
        // Cari data absensi spesifik
        $attendance = Attendance::where('meeting_id', $meeting->id)
                                ->where('user_id', $user->id);

        if ($attendance->exists()) {
            $attendance->delete(); // Hapus data
            return back()->with('success', 'Anggota berhasil dihapus dari daftar hadir.');
        }

        return back()->withErrors('Data absensi tidak ditemukan.');
    }
}
