<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function edit()
    {
        $admin = Auth::user();
        return view('admin.profile', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'password' => 'nullable|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            
            // Encode image as Base64
            $imageData = base64_encode(File::get($image->getPathname()));
            $base64 = 'data:' . $image->getMimeType() . ';base64,' . $imageData;
            
            $data['profile_picture'] = $base64;
            
            // Attempt to delete old file if it was a real file (not base64)
            if ($admin->profile_picture && !str_starts_with($admin->profile_picture, 'data:') && File::exists(public_path($admin->profile_picture))) {
                @File::delete(public_path($admin->profile_picture));
            }
        }

        $admin->update($data);

        return back()->with('success', 'Profile updated successfully.');
    }
}
