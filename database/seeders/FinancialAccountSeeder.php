<?php

namespace Database\Seeders;

use App\Models\AccountType;
use App\Models\Admin;
use App\Models\FinancialAccount;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FinancialAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker          = Factory::create();
        $admin          = Admin::inRandomOrder()->first();
        $account_type   = AccountType::where('name->en', 'Capital')->first();

        $accounts       = [
            [
                'name'              => 'Capita',
                'account_type_id'   => $account_type->id,
                'account_number'    => 1,
                'notes'             => $faker->sentence(10),
                'company_code'      => $admin->company_code,
                'added_by'          => $admin->id,
            ]
        ];

        foreach ($accounts as $account) {
            if (is_null(FinancialAccount::where('name', $account['name'])->first()))
                FinancialAccount::create($account);
        }
    }
}
