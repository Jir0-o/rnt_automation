<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show the profile blade
    public function userProfile()
    {
        $user = Auth::user();
        return view('profile.profile_management', compact('user')); // adjust view path if different
    }

    // Return JSON version of user (for API/show)
public function show()
{
    $user = Auth::user()->load(['department', 'designation', 'roles']); // adjust relation names if different

    return response()->json([
        'data' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'profile_photo_url' => $user->profile_photo_url,
            'department' => $user->department ? [
                'id' => $user->department->id,
                'name' => $user->department->name,
            ] : null,
            'designation' => $user->designation ? [
                'id' => $user->designation->id,
                'designation' => $user->designation->designation,
            ] : null,
            'roles' => $user->roles->map(fn($r) => ['name' => $r->name])->values(),
            'role' => $user->roles->first()?->name,
        ],
    ]);
}


    // Update profile info: name, email, photo
    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['sometimes', 'file', 'image', 'max:1024', 'mimes:jpg,jpeg,png,webp'],
        ];

        $emailChanging = $request->input('email') !== $user->email;

        if ($emailChanging) {
            $rules['current_password_for_email'] = ['required'];
        }

        $validated = $request->validate($rules);

        // If email is changing, verify password
        if ($emailChanging) {
            if (!Hash::check($request->input('current_password_for_email'), $user->password)) {
                return response()->json([
                    'message' => 'Current password for email is incorrect',
                    'errors' => ['current_password_for_email' => ['Current password is incorrect.']],
                ], 422);
            }

            $user->email = $validated['email'];
            // Optionally reset email verification: $user->email_verified_at = null;
        }

        $user->name = $validated['name'];

        // Handle profile photo upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $dir = public_path('global_assets/user_images');
            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }
            $filename = time() . '_' . Str::random(6) . '.' . $file->extension();
            $file->move($dir, $filename);

            if ($user->profile_photo_path && file_exists($dir . '/' . $user->profile_photo_path)) {
                @unlink($dir . '/' . $user->profile_photo_path);
            }

            $user->profile_photo_path = $filename;
        }

        $user->save();

        // If email changed: logout user
        if ($emailChanging) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'message' => 'Email changed. Please log in again.',
                    'logout' => true,
                    'redirect' => route('login'),
                ]);
            }

            return redirect()->route('login')->with('success', 'Email changed. Please log in again.');
        }

        // No email change: keep user logged in, refresh session
        Auth::setUser($user);
        $request->session()->regenerate();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'message' => 'Profile updated successfully',
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'profile_photo_url' => $user->profile_photo_url,
                ],
            ]);
        }

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully');
    }

    // Change password
public function changePassword(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'old_password' => ['required'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ], [
        'password.confirmed' => 'The password confirmation does not match.',
    ]);

    if (!Hash::check($request->old_password, $user->password)) {
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'message' => 'Current password is incorrect',
                'errors' => ['old_password' => ['Current password is incorrect.']],
            ], 422);
        }
        return back()->withErrors(['old_password' => 'Current password is incorrect.']);
    }

    if (Hash::check($request->password, $user->password)) {
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'message' => 'New password must be different from current password',
                'errors' => ['password' => ['New password must be different from current password.']],
            ], 422);
        }
        return back()->withErrors(['password' => 'New password must be different from current password.']);
    }

    $user->password = Hash::make($request->password);
    $user->save();

    // Log the user out after password change
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    if ($request->ajax() || $request->wantsJson()) {
        return response()->json([
            'message' => 'Password changed successfully. Please log in again.',
            'logout' => true,
            'redirect' => route('login'),
        ]);
    }

    return redirect()->route('login')->with('success', 'Password changed successfully. Please log in again.');
}

}
