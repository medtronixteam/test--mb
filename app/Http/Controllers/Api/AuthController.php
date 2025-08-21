<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }



    function signin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()->first(), 'status' => "error"], 400);
        } else {
            try {
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    $token = Auth::user()->createToken('my-users-token')->plainTextToken;
                    return response([
                        'token' => $token,
                        'message' => "Login Successfully",
                    ], 200);
                }
                return response([
                    'message' => "Invalid credentials please try again",
                ], 500);
            } catch (\Throwable $th) {
                return response()->json(['message' => $th->getMessage(), 'status' => "error"], 500);
            }
        }
    }
    function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()->first()], 400);
        } else {
            try {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                $token = $user->createToken('my-users-token')->plainTextToken;
                return response([
                    'token' => $token,
                    'message' => "Account Created Successfully",
                ], 200);
            } catch (\Throwable $th) {
                return response()->json(['message' => $th->getMessage(), 'status' => "error"], 500);
            }
        }
    }
        function signupAsProfessional(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email',
                'first_name' => 'required|string|max:50',
                'last_name' => 'nullable|string|max:50',
                'location' => 'nullable|string|max:100',
                'phone_number' => 'nullable|string|max:25',
                'password' => 'required|string',
            ]);
            if ($validator->fails()) {
                return response()->json(['message' => $validator->messages()->first()], 400);
            } else {
                try {
                    $user = User::create([
                        'name' => $request->first_name . ' ' . $request->last_name,
                        'email' => $request->email,
                        'location' => $request->location,
                        'phone_number' => $request->phone_number,
                        'password' => Hash::make($request->password),
                    ]);
                    $token = $user->createToken('my-users-token')->plainTextToken;
                    return response([
                        'token' => $token,
                        'message' => "Account Created Successfully",
                    ], 200);
                } catch (\Throwable $th) {
                    return response()->json(['message' => $th->getMessage(), 'status' => "error"], 500);
                }
            }
        }
        function signupAsCompany(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email',
                'name' => 'required|string|max:50',
                'website' => 'nullable|string|max:50',
                'location' => 'nullable|string|max:100',
                'password' => 'required|string',
                'phone_number' => 'nullable|string|max:25',
                'industry' => 'nullable|string|max:25',

            ]);
            if ($validator->fails()) {
                return response()->json(['message' => $validator->messages()->first()], 400);
            } else {
                try {
                    $user = User::create([
                        'name' => $request->name,
                        'location' => $request->location,
                        'website' => $request->website,
                        'email' => $request->email,
                        'phone_number' => $request->phone_number,
                        'industry' => $request->industry,
                        'password' => Hash::make($request->password),
                    ]);
                    $token = $user->createToken('my-users-token')->plainTextToken;
                    return response([
                        'token' => $token,
                        'message' => "Account Created Successfully",
                    ], 200);
                } catch (\Throwable $th) {
                    return response()->json(['message' => $th->getMessage(), 'status' => "error"], 500);
                }
            }
        }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'number' => 'string|max:22',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message'  => $validator->errors()->first()
            ], 422);
        }

        $user->update([
            'name' => $request->name,
            'number' => $request->number,
        ]);

        return response()->json([
            'message' => 'Profile updated successfully',
        ]);
    }
}
