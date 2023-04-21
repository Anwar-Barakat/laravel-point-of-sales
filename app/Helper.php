<?php

use App\Models\Shift;
use App\Models\TreasuryTransaction;

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

if (!function_exists('get_treasury_balance')) {
    function get_treasury_balance()
    {
        return TreasuryTransaction::where(['company_code' => app('auth_com'), 'shift_id' => has_open_shift()->id])
            ->sum('money') ?? 0;
    }
}