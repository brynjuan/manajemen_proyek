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

