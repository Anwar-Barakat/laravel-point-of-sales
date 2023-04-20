<?php

use App\Models\Shift;

if (!function_exists('has_open_shift')) {
    function has_open_shift()
    {
        return Shift::with(['treasury:id,name', 'admin:id,name'])->where([
            'admin_id'      => app('auth_id'),
            'company_code'  => app('auth_com'),
            'is_finished'   => 0
        ])->first();
    }
}