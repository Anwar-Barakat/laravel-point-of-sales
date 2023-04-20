<?php

use App\Models\Shift;
use Illuminate\Support\Facades\Auth;

if (!function_exists('has_open_shift')) {
    function has_open_shift($model)
    {
        return Shift::where([
            'admin_id'      => Auth::guard('admin')->id(),
            'company_code'  => Auth::guard('admin')->user()->company_code,
            'is_finished'   => 0
        ])
            ->count() > 0;
    }
}