<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = User::where('id', '!=', 1);
            return DataTables::of($user)
                ->make(true);
        }

        $data['title'] = 'User';
        return view('admin.user.index', $data);
    }

    public function store(Request $request)
    {
        $password = [
            'password' => bcrypt($request->password)
        ];

        $validationPassword = [
            'password' => 'required'
        ];

        // check if $request->id is not empty
        if ($request->id != null) {
            $validationPassword = [];

            // check $request->password is not empty
            if ($request->password == null) {
                $password = [];
            }
        }

        $request->validate(array_merge([
            'name' => 'required',
            'username' => 'required|unique:user,username,' . $request->id,
            'role' => 'required',
        ], $validationPassword));

        $store = User::updateOrCreate([
            'id' => $request->id
        ], array_merge($request->except('password'), $password));

        return response()->json([
            'status' => 'success',
            'message' => $request->id == null ? 'User created successfully' : 'User updated successfully',
            'data' => $store
        ]);
    }

    public function edit($id)
    {
        $findUser = User::find($id);

        return response()->json([
            'status' => 'success',
            'data' => $findUser
        ]);
    }

    public function destroy($id)
    {
        $findUser = User::find($id);

        if ($findUser) {
            $findUser->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'User deleted successfully',
            ]);
        }
    }
}
