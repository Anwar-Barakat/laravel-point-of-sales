<?php

use App\Models\Account;
use App\Models\Order;
use App\Models\Shift;
use App\Models\TreasuryTransaction;
use App\Models\Vendor;
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

if (!function_exists('get_transaction')) {
    function get_transaction()
    {
        return TreasuryTransaction::where(['company_code' => get_auth_com(), 'shift_id' => has_open_shift()->id])->first();
    }
}

if (!function_exists('update_account_balance')) {
    function update_account_balance(Account $account)
    {
        if ($account->accountType->name = 'Vendor') {
            $vendor_order_balance       = Order::where(['account_id' => $account->id, 'company_code' => get_auth_com()])->sum('money_for_account');
            $vendor_transaction_balance = TreasuryTransaction::where(['account_id' => $account->id, 'company_code' => get_auth_com()])->sum('money_for_account');
            $final_balamce              = $account->vendor->initial_balance + $vendor_order_balance + $vendor_transaction_balance;

            $account->update(['current_balance' => $final_balamce]);
            $account->vendor->update(['current_balance' => $final_balamce]);
        }
    }
}