<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    public function create(Request $request, $token = null)
    {
        return view('admin.auth.reset-password')->with(['token' => $token, 'email' => $request->email]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'token'     => ['required'],
            'email'     => ['required', 'email'],
            'password'  => ['required', 'confirmed', Password::defaults()],
        ]);

        $check_token    = DB::table('password_reset_tokens')->where([
            'token'     => $request->token,
            'email'     => $request->email
        ])->first();

        if (!$check_token) {
            toastr()->error(__('msgs.try_again'));
            return redirect()->back()->withInput();
        }

        Admin::where('email', $request->email)->update(['password'   => Hash::make($request->password)]);
        $check_token    = DB::table('password_reset_tokens')->where([
            'token'     => $request->token,
            'email'     => $request->email
        ])->delete();

        toastr()->success(__('msgs.updated', ['name' => __('auth.password')]));
        return redirect()->route('admin.login.show');
    }
}
