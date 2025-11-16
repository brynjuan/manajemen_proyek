<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HistoryController extends Controller
{
    public function index(): View
    {
        $meetings = Auth::user()
            ->meetingsAttended()
            ->orderByDesc('meetings.time')
            ->get();

        return view('anggota.history', compact('meetings'));
    }
}
