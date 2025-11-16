<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Meeting;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MeetingController extends Controller
{
    public function create(): View
    {
        return view('admin.meetings.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'time' => ['required', 'date'],
            'location' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $meeting = Meeting::create([
            'title' => $validated['title'],
            'time' => $validated['time'],
            'location' => $validated['location'],
            'description' => $validated['description'] ?? null,
            'status' => 'ongoing',
        ]);

        return redirect()->route('admin.meetings.scan', $meeting);
    }

    public function ongoing(): View
    {
        $meetings = Meeting::where('status', 'ongoing')->orderByDesc('time')->get();

        return view('admin.meetings.ongoing', compact('meetings'));
    }

    public function scan(Meeting $meeting): View
    {
        if ($meeting->status !== 'ongoing') {
            return redirect()
                ->route('admin.meetings.ongoing')
                ->withErrors('Rapat ini sudah tidak berstatus ongoing.');
        }

        return view('admin.meetings.scan', compact('meeting'));
    }

    public function storeScan(Request $request, Meeting $meeting): JsonResponse
    {
        $data = $request->validate([
            'qr_data' => ['required', 'string'],
        ]);

        if ($meeting->status !== 'ongoing') {
            return response()->json([
                'status' => 'error',
                'message' => 'Rapat sudah selesai.',
            ], 422);
        }

        $user = User::where('qr_data', $data['qr_data'])->first();

        if (! $user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anggota tidak ditemukan.',
            ], 404);
        }

        $alreadyAttended = Attendance::where('meeting_id', $meeting->id)
            ->where('user_id', $user->id)
            ->exists();

        if ($alreadyAttended) {
            return response()->json([
                'status' => 'warning',
                'message' => 'Anggota sudah diabsen sebelumnya.',
                'name' => $user->name,
            ], 409);
        }

        Attendance::create([
            'meeting_id' => $meeting->id,
            'user_id' => $user->id,
            'attended_at' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Absen berhasil.',
            'name' => $user->name,
        ]);
    }

    public function finish(Meeting $meeting): RedirectResponse
    {
        if ($meeting->status === 'finished') {
            return redirect()
                ->route('admin.reports.show', $meeting)
                ->with('success', 'Rapat sudah diselesaikan.');
        }

        $meeting->update(['status' => 'finished']);

        return redirect()
            ->route('admin.reports.show', $meeting)
            ->with('success', 'Rapat berhasil diakhiri.');
    }
}
