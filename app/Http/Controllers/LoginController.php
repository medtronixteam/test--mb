<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
class LoginController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Auth::login($user);
        return redirect()->route('user.dashboard');
    }
  public function auth(Request $request)
{
     $valid = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

    if (Auth::attempt($valid)) {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        } elseif ($user->role === 'warehouse') {
            return redirect()->route('warehouse.dashboard');
        }
    }

    return redirect()->back()->with('error', 'Invalid email or password.');
}

public function showForgotForm()
{
    return view('forget_password');
}

public function submitForgotForm(Request $request)
{
    $request->validate([
        'email' => 'required|email|',
    ]);
    $user = User::where('email', $request->email)->first();
    if( !$user) {
        return back()->with('error', 'User Not Found');
    }
    $otp = rand(100000, 999999);
    Cache::put('otp_' . $request->email, $otp, now()->addMinutes(2));

    Mail::raw("Your OTP is: $otp", function ($message) use ($request) {
        $message->to($request->email)->subject('Your OTP');
    });

    session(['email' => $request->email]);
    // flashy()->success('OTP sent to your email.', '#');
    return redirect()->route('otp.form')->with('success', 'OTP sent to your email.');

}
public function showVerifyOtpForm()
{
    return view('otp');
}

public function submitOtpForm(Request $request)
{
    $request->validate([
        'otp' => 'required',
    ]);

    $email = session('email');
    $cachedOtp = Cache::get('otp_' . $email);

    if ($cachedOtp != $request->otp) {
        return back()->with('error', 'Invalid OTP. Please try again.');
    }

    Cache::forget('otp_' . $email);
    session(['otp_verified' => true]);

    return redirect()->route('reset.form')->with('success', 'OTP verified successfully. You can now reset your password.');
}

public function showResetForm()
{
    if (!session('otp_verified')) {
        return redirect()->route('forgot.form');
    }

    return view('reset_password');
}

public function submitResetForm(Request $request)
{
    $request->validate([
        'new_password' => 'required|min:4 ',
    ]);

    $user = User::where('email', session('email'))->first();
    $user->password = Hash::make($request->new_password);
    $user->save();

    session()->forget(['email', 'otp_verified']);

    return redirect()->route('login')->with('success', 'Password reset successfully.');
}
  public function delete($id)
{
    $user = User::findOrFail($id);
    if ($user->delete()) {
        return redirect()->route('login')->with('success', 'Account deleted successfully.');
    } else {
        return redirect()->back()->with('error', 'Failed to delete account.');
    }
}
}
