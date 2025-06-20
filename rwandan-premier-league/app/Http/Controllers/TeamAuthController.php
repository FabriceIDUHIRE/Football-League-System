<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;

class TeamAuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        if (Auth::guard('team')->check()) { // ✅ Check if already logged in
            return redirect()->route('team.dashboard');
        }

        return view('auth.team-login');
    }

    // ✅ Improved login method
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');
    
        // Debugging: Check credentials
        dd($credentials, Auth::guard('team')->attempt($credentials, $remember));  // This will show the credentials and whether authentication passes or fails
    
        if (Auth::guard('team')->attempt($credentials, $remember)) {
            $user = Auth::guard('team')->user();
    
            // Ensure the session stores the correct user ID
            session(['user_id' => $user->id]);
    
            // Ensure the user is assigned to a team
            if (!$user->team) {
                Auth::guard('team')->logout();
                return back()->withErrors(['error' => 'You are not assigned to any team.']);
            }
    
            session()->regenerate(); // Regenerate the session ID
    
            return redirect()->route('team.dashboard');
        }
    
        return back()->withErrors(['error' => 'Invalid email or password.']);
    }
    
    

    

    

    // ✅ Send Magic Link for Quick Login
    public function sendMagicLink(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['error' => 'Email not found.']);
        }

        $token = Str::random(64);
        $user->update(['remember_token' => $token]);

        $link = route('team.magic.login', ['token' => $token]);

        Mail::raw("Click here to log in: $link", function ($message) use ($user) {
            $message->to($user->email)->subject('Your Magic Login Link');
        });

        return back()->with('success', 'A login link has been sent to your email.');
    }

    // ✅ Secure Magic Link Login
    public function magicLogin($token)
    {
        $user = User::where('remember_token', $token)->first();

        if (!$user) {
            return redirect()->route('team.login')->withErrors(['error' => 'Invalid or expired link.']);
        }

        Auth::guard('team')->login($user);

        // ✅ Clear the token after successful login
        $user->update(['remember_token' => null]);

        return redirect()->route('team.dashboard');
    }



    // Send Password Reset Link
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => 'Password reset link sent!'])
            : back()->withErrors(['email' => 'Could not find a user with that email.']);
    }

    // Show Reset Form
    public function showResetForm($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }

    // Handle Reset Password
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'token' => 'required'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Password reset successful!')
            : back()->withErrors(['email' => 'Failed to reset password.']);
    }

    
    
}
