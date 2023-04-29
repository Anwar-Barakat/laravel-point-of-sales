<?php

use App\Models\Account;
use App\Models\Item;
use App\Models\ItemBatch;
use App\Models\Order;
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

if (!function_exists('batch_item_qty')) {
    function item_batch_qty(Item $item, $store_id = null)
    {
        return ItemBatch::where(['item_id' => $item->id, 'is_archieved' => 0, 'company_code' => get_auth_com()])
            ->when($store_id, function ($query, $store_id) {
                return $query->where('store_id', $store_id);
            })->sum('qty');
    }
}

if (!function_exists('update_item_qty')) {
    function update_item_qty(Item $item)
    {
        $batches_qty = item_batch_qty($item);
        if ($item->has_retail_unit == 1) {
            //________ qty in batches are put as a parent unit ________
            $item->all_retail_qty     = $batches_qty * $item->retail_count_for_wholesale; // 81 * 10 = 810
            $item->wholesale_qty      = floor($batches_qty); // 81 => 80
            $item->retail_qty         = fmod($item->all_retail_qty, $item->retail_count_for_wholesale); // 81 % 20 = 1
        } else
            $item->wholesale_qty      = $batches_qty;

        return $item;
    }
}
