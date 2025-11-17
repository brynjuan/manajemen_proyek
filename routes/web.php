<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\MeetingController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Member\DashboardController as MemberDashboardController;
use App\Http\Controllers\Member\HistoryController;
use App\Http\Controllers\Member\QrCodeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/members', [MemberController::class, 'index'])->name('members.index');
    Route::get('/members/create', [MemberController::class, 'create'])->name('members.create');
    Route::post('/members', [MemberController::class, 'store'])->name('members.store');

    Route::get('/members/{member}/edit', [MemberController::class, 'edit'])->name('members.edit');
    Route::put('/members/{member}', [MemberController::class, 'update'])->name('members.update');
    Route::delete('/members/{member}', [MemberController::class, 'destroy'])->name('members.destroy');

    Route::get('/meetings/create', [MeetingController::class, 'create'])->name('meetings.create');
    Route::post('/meetings', [MeetingController::class, 'store'])->name('meetings.store');
    Route::get('/meetings/ongoing', [MeetingController::class, 'ongoing'])->name('meetings.ongoing');
    Route::get('/meetings/{meeting}/scan', [MeetingController::class, 'scan'])->name('meetings.scan');
    Route::post('/meetings/{meeting}/scan', [MeetingController::class, 'storeScan'])->name('meetings.scan.store');
    Route::post('/meetings/{meeting}/finish', [MeetingController::class, 'finish'])->name('meetings.finish');

    Route::get('/meetings/{meeting}/edit', [MeetingController::class, 'edit'])->name('meetings.edit');
    Route::put('/meetings/{meeting}', [MeetingController::class, 'update'])->name('meetings.update');
    Route::delete('/meetings/{meeting}', [MeetingController::class, 'destroy'])->name('meetings.destroy');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/{meeting}', [ReportController::class, 'show'])->name('reports.show');
    Route::get('/reports/{meeting}/pdf', [ReportController::class, 'download'])->name('reports.pdf');
    Route::post('/reports/{meeting}/attendances', [ReportController::class, 'addAttendance'])->name('reports.attendances.add');
    Route::delete('/reports/{meeting}/attendances/{user}', [ReportController::class, 'removeAttendance'])->name('reports.attendances.remove');

    Route::get('/profile', [ProfileController::class, 'admin'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'updateAdmin'])->name('profile.update');
});

Route::middleware(['auth', 'role:anggota'])->prefix('anggota')->name('anggota.')->group(function () {
    Route::get('/dashboard', [MemberDashboardController::class, 'index'])->name('dashboard');
    Route::get('/qr-code', [QrCodeController::class, 'show'])->name('qr');
    Route::get('/history', [HistoryController::class, 'index'])->name('history');
    Route::get('/profile', [ProfileController::class, 'member'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'updateMember'])->name('profile.update');
    Route::view('/contact', 'anggota.contact')->name('contact');
});