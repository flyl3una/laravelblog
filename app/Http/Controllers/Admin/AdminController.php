<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index()
    {
        return view('admin.system.index');
    }

    public function user($id)
    {
        $id = intval($id);
        $user = User::where('id', $id)->first();
        return view('admin.user.index', compact('user'));
    }
}
