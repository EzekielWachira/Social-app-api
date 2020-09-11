<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user || Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'credentials' => 'The provided credentials do not match with our records'
            ]);
        }
        return $user->createToken('Auth Token')->plainTextToken;
    }

    public function logout(Request $request){
        $request->tokens()->delete();
    }
}
