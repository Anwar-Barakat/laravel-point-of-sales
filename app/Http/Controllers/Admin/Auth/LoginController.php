<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials    = $request->only(['email', 'password']);

        if (!Auth::guard('admin')->attempt($credentials)) {
            toastr()->error('Oops, Invalid Email or Password');
            return redirect()->back();
        }

        Auth::guard('admin')->attempt($credentials);
        toastr()->success('Welcome Back');
        return redirect()->route('admin.dashboard');
    }
}
