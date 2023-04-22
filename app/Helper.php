<?php

use App\Models\Shift;
use App\Models\TreasuryTransaction;
use Illuminate\Support\Facades\Auth;

if (!function_exists('get_auth_id')) {
    function get_auth_id()
    {
        return Auth::guard('admin')->user()->id;
    }
}

if (!function_exists('get_auth_com')) {
    function get_auth_com()
    {
        return Auth::guard('admin')->user()->company_code;
    }
}

if (!function_exists('has_open_shift')) {
    function has_open_shift()
    {
        return Shift::with(['treasury:id,name', 'admin:id,name'])->where([
            'admin_id'      => get_auth_id(),
            'company_code'  => get_auth_com(),
            'is_finished'   => 0
        ])->first();
    }
}

if (!function_exists('get_treasury_balance')) {
    function get_treasury_balance()
    {
        return TreasuryTransaction::where(['company_code' => get_auth_com(), 'shift_id' => has_open_shift()->id])
            ->sum('money') ?? 0;
    }
}