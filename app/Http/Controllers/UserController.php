<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\League;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use App\Models\Product;
use App\Models\Order;
use App\Models\Refund;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    function forgetpassword()
    {
        return view('auth-forgot-password');
    }
    function auth_login()
    {
        return view('auth-login');
    }
    function auth_register()
    {
        return view('auth-register');
    }
    function reset_password()
    {
        return view('auth-reset-password');
    }
    function blank()
    {
        return view('blank');
    }
      function dashboard()
    {
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalWarehouses = User::where('role', 'warehouse')->count();

        return view('dashboard', compact('totalUsers', 'totalAdmins', 'totalWarehouses'));
    }
      function WarehouseDashboard()
    {
        $totalOrders = Order::count();
        $totalRefunds = Refund::count();
        $totalProducts = Product::where('isActive', 1)->count();

        return view('warehouse.dashboard', compact( 'totalProducts','totalOrders','totalRefunds'));
    }
    function logout()
    {
        Auth::logout();
        return redirect()->route('auth-login');
    }

      public function profile(){
        return view('profile');
    }
    public function resetPass(Request $request) {
        $validatedData = $request->validate([
            "new_password" => ['required', 'min:5'],
            "confirm_password" => ['required', 'same:new_password'],
        ]);

        if ($validatedData) {
            $user = User::find(Auth::user()->id);
            if ($user) {
                $user->update(['password' => Hash::make($validatedData["new_password"])]);
                return back()->with('success', 'Password has been updated successfully!');
            } else {
                return back()->with('error', 'Invalid User Id');
            }
        }

}
}
