<?php

use App\Models\ItemBatch;

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
            ->where(['company_id'         => get_auth_com()])
            ->when($prod->item_id,     fn ($q) => $q->where(['item_id'     => $prod->item_id]))
            ->when($prod->store_id,    fn ($q) => $q->where(['store_id'    => $prod->store_id]))
            ->when($prod->unit_id,     fn ($q) => $q->where(['unit_id'     => $prod->item->parentUnit->id]))
            ->when($prod->item->type == 2,      fn ($q) => $q->orderBy('production_date', 'asc'))
            ->latest()->get();
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