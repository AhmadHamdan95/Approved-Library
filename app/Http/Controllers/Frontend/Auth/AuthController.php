<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Auth\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return response()->view('frontend.auth.index');
    }

    public function update(AuthRequest $request)
    {
        $credentials = $request->validated();
        if(Auth::guard('customer')->attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return redirect()->route('loginPage')->withErrors([
            'message' => 'Wrong email or password!'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        return redirect()->route('loginPage');
    }
}