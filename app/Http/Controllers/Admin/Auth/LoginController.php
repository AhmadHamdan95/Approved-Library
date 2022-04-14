<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return response()->view('admin.auth.index');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (Auth::guard('admin')->attempt($credentials, $request->get('remember_token')))
        {
            $request->session()->regenerate();
            return redirect()->intended('admin/dashboard');
        }
        return redirect()->route('admin.auth.showLogin')->withErrors([
            'message' => 'Wrong email or password!',
        ]);
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->route('admin.auth.showLogin');
    }
}
