<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contactus;
class ContactUsController extends Controller
{
     public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'first_name'   => 'required|string|max:50',
                'last_name'    => 'nullable|string|max:50',
                'email'        => 'required|email|max:100',
                'phone_number' => 'nullable|string|max:20',
                'inquiry_type' => 'required|string|max:100',
                'message'      => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->messages()->first(), 'status' => "error"], 400);
        }
        Contactus::create($validator->validated());
           return response([
                    'message' =>"Your message has been sent successfully!",
                ], 200);
    }

}
