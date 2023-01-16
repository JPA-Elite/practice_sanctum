<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\revenue;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            "message" => "log out",
        ];
    }
    public function login(Request $request)
    {
        $validated = $request->validate(
            [
                'username' => 'required|string|min:5|max:10',
                'password' => 'required',
            ]
        );

        $user = revenue::where('username', $validated['username'])->first();

        if ($user && Hash::check($validated['password'], $user-> password)){
            $token = $user->createToken('login', ['create'])->plainTextToken;
            return response(
                [
                    'message' => "Successfully login",
                    'token' =>  $token
                ]
            );
        }else {
            return response(
                [
                    'message' => "Bad Credentials"
                ]
            );
        }

    }
}
