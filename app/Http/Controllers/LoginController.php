<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
    
        if ($email === 'admin@example.com' && $password === '123456') {
            return response()->json([
                'message' => 'Login berhasil',
                'user' => [
                    'email' => $email,
                    'name' => 'Admin'
                ]
            ]);
        } else {
            return response()->json(['message' => 'Login gagal'], 401);
        }
    }
}