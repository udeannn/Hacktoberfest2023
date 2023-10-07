<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\UploadFileService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $data['title'] = 'Setting';
        return view('admin.setting.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'application_name' => 'required',
            'store_name' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $setting = Setting::first();

        $logo = UploadFileService::upload($request->file('logo'), 'setting/', $setting?->logo);
        $favicon = UploadFileService::upload($request->file('favicon'), 'setting/', $setting?->favicon);

        $setting = Setting::updateOrCreate(
            ['id' => 1],
            [
                'application_name' => $request->application_name,
                'store_name' => $request->store_name,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'logo' => $logo,
                'favicon' => $favicon,
                'address' => $request->address,
            ]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Setting updated successfully',
            'data' => $setting,
        ], 200);
    }
}
