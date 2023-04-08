<?php

namespace App\Http\Controllers\Admin\GeneralSetting\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminChangePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('admin.general-settings.settings.change-password');
    }
}