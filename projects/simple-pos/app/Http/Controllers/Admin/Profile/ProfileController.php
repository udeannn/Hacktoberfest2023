<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $data['title'] = 'Profile';
        return view('admin.profile.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'nullable|min:8',
            'password_confirmation' => 'nullable|same:password',
        ]);

        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully',
            'data' => $user,
        ], 200);
    }
}
