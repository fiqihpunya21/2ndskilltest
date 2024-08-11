<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken('MyToken');
            
            return response()->json([
                'token' => $token->plainTextToken
            ]);
            
            /*
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
            */
        }

        return response()->json(['message' => 'Credentials are not valid!'], 401);
    
    }
}
