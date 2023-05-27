<?php

use App\Models\ItemBatch;

if (!function_exists('calc_total_price')) {
    function calc_total_price($product)
    {
        return $product->total_price = intval($product->qty) * floatval($product->unit_price);;
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
