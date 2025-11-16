<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        $meetings = Meeting::orderByDesc('time')->get();

        return view('admin.reports.index', compact('meetings'));
    }

    public function show(Meeting $meeting): View
    {
        $meeting->load(['attendees' => function ($query) {
            $query->orderBy('users.nim');
        }]);

        return view('admin.reports.show', compact('meeting'));
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
}
