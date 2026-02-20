<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Returns the configured default filesystem disk name.
     * Uses FILESYSTEM_DISK env var — 's3' on Vercel, 'public' locally.
     */
    private function storageDisk(): string
    {
        return config('filesystems.default', 'public');
    }

    public function edit()
    {
        $admin = Auth::user();
        return view('admin.profile', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:admins,email,' . $admin->id,
            'password'        => 'nullable|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');

            // Delete old profile picture if it's a stored file (not base64)
            if ($admin->profile_picture && !str_starts_with($admin->profile_picture, 'data:')) {
                Storage::disk($this->storageDisk())->delete($admin->profile_picture);
            }

            $filename = 'profile_' . time() . '_' . Str::random(6) . '.' . $image->getClientOriginalExtension();
            $path     = $image->storeAs('images/profile_pictures', $filename, $this->storageDisk());

            $data['profile_picture'] = $path;
        }

        $admin->update($data);

        return back()->with('success', 'Profile updated successfully.');
    }
}
