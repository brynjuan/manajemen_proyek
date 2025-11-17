<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User; // <-- [BARU] Tambahkan ini
use App\Models\Meeting; // <-- [BARU] Tambahkan ini

class AdminDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(): View
    {
        // [BARU] Ambil data statistik
        $totalMembers = User::where('role', 'anggota')->count();
        $finishedMeetings = Meeting::where('status', 'finished')->count();
        $ongoingMeetings = Meeting::where('status', 'ongoing')->count();

        // [BARU] Ambil data untuk grafik (10 rapat terakhir yang selesai)
        $meetings = Meeting::where('status', 'finished')
            ->withCount('attendees') // Menghitung jumlah relasi attendees
            ->orderByDesc('time')
            ->limit(10)
            ->get()
            ->reverse(); // Balik urutan agar rapat terlama di kiri

        // Siapkan data untuk Chart.js
        $chartLabels = $meetings->pluck('title');
        $chartData = $meetings->pluck('attendees_count');

        return view('admin.dashboard', compact(
            'totalMembers',
            'finishedMeetings',
            'ongoingMeetings',
            'chartLabels',
            'chartData'
        ));
    }
}