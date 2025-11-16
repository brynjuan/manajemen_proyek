<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', function () {
    return view('home');
}); 

Route::get('dashboard', function () {
    return view('dashboard');
});

Route::get('profile', function () {
    return view('profile');
});

Route::get('contact', function () {
    return view('contact');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/members', [MemberController::class, 'index'])->name('members.index');
    Route::get('/members/create', [MemberController::class, 'create'])->name('members.create');

    Route::get('/profile', [ProfileController::class, 'admin'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'updateAdmin'])->name('profile.update');
});