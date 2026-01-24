<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Exception;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            // Check if the admin exists with this google_id
            $findAdmin = Admin::where('google_id', $user->id)->first();

            if ($findAdmin) {
                Auth::guard('admin')->login($findAdmin);
                return redirect()->route('admin.dashboard');
            } else {
                // Alternatively, check by email if the google_id is not set yet
                $adminByEmail = Admin::where('email', $user->email)->first();

                if ($adminByEmail) {
                    $adminByEmail->update([
                        'google_id' => $user->id
                    ]);
                    Auth::guard('admin')->login($adminByEmail);
                    return redirect()->route('admin.dashboard');
                }

                // If you want to automatically create an admin, uncomment below.
                // For security, usually, you want to link existing admins only.
                /*
                $newAdmin = Admin::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('alrabie-admin-google-auth') // Placeholder password
                ]);
                Auth::guard('admin')->login($newAdmin);
                return redirect()->route('admin.dashboard');
                */

                return redirect()->route('admin.login')->with('error', 'No admin account found with this Google email.');
            }
        } catch (Exception $e) {
            return redirect()->route('admin.login')->with('error', 'Google authentication failed. ' . $e->getMessage());
        }
    }
}
