<?php

use App\Models\Order;
use App\Models\Sale;
use App\Models\ServiceInvoice;
use App\Models\TreasuryTransaction;

if (!function_exists('get_account_orders')) {
    function get_account_orders($type, $account_id, $fromDate, $toDate)
    {
        $query =  Order::with('orderProducts')->byTypeAndCompany($type)
            ->select('id', 'is_approved', 'invoice_type', 'invoice_date', 'cost_after_discount', 'paid', 'remains', 'money_for_account')
            ->where(['account_id' => $account_id, 'company_id' => get_auth_com()]);

        if ($fromDate)
            $query->whereBetween('invoice_date', [$fromDate, $toDate]);

        return $query->get();
    }
}

if (!function_exists('get_account_sales')) {
    function get_account_sales($type, $account_id, $fromDate, $toDate)
    {
        $query =  Sale::with('saleProducts')->byTypeAndCompany($type)
            ->select('id', 'is_approved', 'invoice_type', 'invoice_date', 'cost_after_discount', 'paid', 'remains', 'money_for_account')
            ->where(['account_id' => $account_id, 'company_id' => get_auth_com()]);

        if ($fromDate)
            $query->whereBetween('invoice_date', [$fromDate, $toDate]);

        return $query->get();
    }
}

if (!function_exists('get_account_services')) {
    function get_account_services($account_id, $fromDate, $toDate)
    {
        $query = ServiceInvoice::with('serviceInvoiceDetails')
            ->select('id', 'is_approved', 'service_type', 'invoice_type', 'invoice_date', 'cost_after_discount', 'paid', 'remains', 'money_for_account')
            ->where(['account_id' => $account_id, 'company_id' => get_auth_com()]);

        if ($fromDate)
            $query->whereBetween('invoice_date', [$fromDate, $toDate]);
        return $query->get();
    }
}

if (!function_exists('get_account_transactions')) {
    function get_account_transactions($account_id, $fromDate, $toDate)
    {
        $query = TreasuryTransaction::with(['shift_type:id,name', 'treasury:id,name'])
            ->where('money_for_account', '<>', 0)
            ->where(['account_id' => $account_id, 'company_id' => get_auth_com()]);

        if ($fromDate)
            $query->whereBetween('transaction_date', [$fromDate, $toDate]);
        return $query->get();
    }
}
