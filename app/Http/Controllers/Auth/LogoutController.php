<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    //
    public function logout()
    {
        Auth::logout();
        session()->forget('user');
        return redirect()->back();
    }
}
