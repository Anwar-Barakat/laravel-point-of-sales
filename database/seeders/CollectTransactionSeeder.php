<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Admin;
use App\Models\Shift;
use App\Models\TreasuryTransaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollectTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin      = Admin::where('email', 'admin@admin.com')->first();
        $shift      = Shift::where('admin_id', $admin->id)->first();
        $account    = Account::where('number', 8)->first(); // islamic bank

        TreasuryTransaction::create([
            'money'             => 20000, // treasury is debit
            'shift_id'          => $shift->id,
            'shift_type_id'     => 16, // Borrowing from a bank
            'admin_id'          => $admin->id,
            'treasury_id'       => $shift->treasury->id,
            'payment'           => $shift->treasury->last_payment_exchange + 1,
            'is_approved'       => 1,
            'is_account'        => 1,
            'account_id'        => $account->id,
            'money_for_account' => floatval(-20000),
            'company_id'        => $admin->company->id,
            'transaction_date'  => date('Y-m-d'),
            'report'            => 'Borrowing from a bank'
        ]);

        $account->update(['current_balance' => floatval(-20000)]);


        $shift->treasury->increment('last_payment_collect');
    }
}