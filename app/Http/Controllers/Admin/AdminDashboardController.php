<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'totalMembers' => User::where('role', 'anggota')->count(),
            'ongoingMeetings' => Meeting::where('status', 'ongoing')->count(),
            'finishedMeetings' => Meeting::where('status', 'finished')->count(),
        ]);
    }
}
