<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.index');
    }

    public function login(Request $request)
    {
        $auth = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (auth()->attempt($auth)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Username or password is incorrect');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();

        return redirect()->route('login');
    }
}
