<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $token = Auth::user()->createToken('token-name')->plainTextToken;
            $user=Auth::user();
            return response()->json(['token' => $token, 'user' =>$user]);
        }

        return response()->json(['message' => 'Credenciais inválidas'], 401);
    }


}

