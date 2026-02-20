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
            
            // Store using Storage facade instead of Base64 (more efficient and Vercel compatible)
            $filename = 'profile_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('images/profile_pictures', $filename, 'public');
            
            $data['profile_picture'] = $path;
            
            // Attempt to delete old file if it was a real file (not base64)
            if ($admin->profile_picture && !str_starts_with($admin->profile_picture, 'data:') && \Illuminate\Support\Facades\Storage::disk('public')->exists($admin->profile_picture)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($admin->profile_picture);
            }
        }

        $admin->update($data);

        return back()->with('success', 'Profile updated successfully.');
    }
}
