<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|unique:admins,email,' . $admin->id,
            'password'        => 'nullable|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
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

            // Store as Base64 in the database — works on all platforms including Vercel
            $imageData = base64_encode(file_get_contents($image->getPathname()));
            $data['profile_picture'] = 'data:' . $image->getMimeType() . ';base64,' . $imageData;
        }

        $admin->update($data);

        return back()->with('success', 'Profile updated successfully.');
    }
}
