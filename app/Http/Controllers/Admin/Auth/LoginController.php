<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function show()
    {
        if (Auth::guard('admin')->check())
            return redirect()->route('admin.dashboard');

        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $this->validate($request, [
            'email'     => ['required', 'email', 'max:100'],
            'password'  => ['required', 'min:6']
        ]);

        if (Auth::guard('admin')->check())
            return redirect()->route('admin.dashboard');

        if (!Auth::guard('admin')->attempt($credentials)) {
            toastr()->error(__('msgs.email_pass_not_valid'));
            return redirect()->route('admin.login.show');
        }

        Auth::guard('admin')->attempt($credentials);
        toastr()->success(__('msgs.welcome_back'));
        return redirect()->route('admin.dashboard');
    }
}
