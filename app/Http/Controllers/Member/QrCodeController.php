<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class QrCodeController extends Controller
{
    public function show(): View
    {
        return view('anggota.qr-code', ['user' => Auth::user()]);
    }
}
