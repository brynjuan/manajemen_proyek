<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        return view('anggota.dashboard', [
            'attendanceCount' => $user->attendances()->count(),
            'ongoingMeetings' => Meeting::withCount('attendances')
                ->where('status', 'ongoing')
                ->orderBy('time')
                ->get(),
        ]);
    }
}
