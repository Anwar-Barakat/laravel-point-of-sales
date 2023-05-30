<?php

use App\Models\Account;
use App\Models\ItemBatch;
use App\Models\Order;
use App\Models\ProductReceive;
use App\Models\Sale;
use App\Models\ServiceInvoice;
use App\Models\TreasuryTransaction;

if (!function_exists('calc_total_price')) {
    function calc_total_price($product)
    {
        return $product->total_price = intval($product->qty) * floatval($product->unit_price);
    }
}

if (!function_exists('get_unit_price')) {
    function get_unit_price($unit, $batch)
    {
        return $unit->status == 'retail' ? $batch->unit_price / $batch->item->retail_count_for_wholesale : $batch->unit_price;
    }
}

if (!function_exists('getBatches')) {
    function getBatches($prod, $item = null)
    {
        return ItemBatch::select('id', 'unit_price', 'qty', 'production_date', 'expiration_date')
            ->where(['company_id'         => get_auth_com()])->where('qty', '>', 0)
            ->when($prod->item_id,     fn ($q) => $q->where(['item_id'     => $prod->item_id]))
            ->when($prod->store_id,    fn ($q) => $q->where(['store_id'    => $prod->store_id]))
            ->when($prod->unit_id,     fn ($q) => $q->where(['unit_id'     => $prod->item->parentUnit->id]))
            ->when($prod->item->type == 2,      fn ($q) => $q->orderBy('production_date', 'asc'))
            ->latest()->get();
    }
}

if (!function_exists('update_account_balance')) {

    function update_account_balance(Account $account)
    {
        $balance    = $account->initial_balance;

        $balance    += TreasuryTransaction::where(['account_id' => $account->id, 'company_id' => get_auth_com()])->sum('money_for_account');
        $balance    += ServiceInvoice::where(['account_id' => $account->id, 'company_id' => get_auth_com()])->sum('money_for_account');


        if ($account->accountType->id == 1) {
            // vendor
            $balance    += Order::where(['account_id' => $account->id, 'company_id' => get_auth_com()])->sum('money_for_account');
        } elseif ($account->accountType->id == 2) {
            // customer
            $balance    += Sale::where(['account_id' => $account->id, 'company_id' => get_auth_com()])->sum('money_for_account');
        } elseif ($account->accountType->id == 3) {
            // delegate
            $balance    += Sale::where(['delegate_id' => $account->delegate->id, 'company_id' => get_auth_com()])->sum('commission_value');
        } elseif ($account->accountType->id == 5) {
            // workshop
            $balance    += ProductReceive::where(['account_id' => $account->id, 'company_id' => get_auth_com()])->sum('money_for_account');
        }

        $account->update(['current_balance' => $balance]);
    }
}


// Apprving Invoice Methods


if (!function_exists('get_tax_value')) {
    function get_tax_value($invoice)
    {
        return $invoice->tax_type == 0
            ? ($invoice->items_cost * floatval($invoice->tax_value)) / 100
            : floatval($invoice->tax_value);
    }
}
if (!function_exists('get_discount_value')) {
    function get_discount_value($invoice)
    {
        return $invoice->discount_type == 0
            ? (floatval($invoice->items_cost) * floatval($invoice->discount_value)) / 100
            : floatval($invoice->discount_value);
    }
}