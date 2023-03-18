<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Admin\AdminResetPassword;
use Carbon\Carbon;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordRestLinkController extends Controller
{
    public function create(): View
    {
        return view('admin.auth.forget-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'     => ['required', 'email', 'exists:admins,email']
        ]);

        $token  = Str::random(64);
        DB::table('password_reset_tokens')->insert([
            'email'         => $request->email,
            'token'         => $token,
            'created_at'    => Carbon::now()
        ]);

        $action_link    = route('admin.password.reset.link', ['token' => $token, 'email' => $request->email]);

        $mailData       = [
            'link'  => $action_link,
            'email' => $request->email
        ];

        Mail::to($request->email)->send(new AdminResetPassword($mailData));

        toastr()->info(__('msgs.password_reset_link'));
        return back();
    }
}
