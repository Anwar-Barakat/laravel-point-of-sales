<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Shift;
use App\Models\TreasuryTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExchangeTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::where('email', 'admin@admin.com')->first();
        $shift = Shift::where('admin_id', $admin->id)->first();

        TreasuryTransaction::create([
            'money'             => floatval(-1000), // treasury is credit
            'shift_id'          => $shift->id,
            'shift_type_id'     => 8, // Disbursement for an invoice for purchases from a supplier
            'admin_id'          => $admin->id,
            'treasury_id'       => $shift->treasury->id,
            'payment'           => $shift->treasury->last_payment_exchange + 1,
            'is_approved'       => 1,
            'is_account'        => 1,
            'money_for_account' => 1000,
            'company_code'      => $admin->company_code,
            'transaction_date'  => date('Y-m-d'),
            'report'            => 'Disbursement for an invoice for purchases from a supplier'
        ]);
        $shift->treasury->increment('last_payment_exchange');
    }
}
