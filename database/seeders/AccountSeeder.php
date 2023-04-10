<?php

namespace Database\Seeders;

use App\Models\AccountType;
use App\Models\Admin;
use App\Models\Account;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker          = Factory::create();
        $admin          = Admin::inRandomOrder()->first();
        $captial_type   = AccountType::where('name->en', 'Capital')->first();
        $general_type   = AccountType::where('name->en', 'General')->first();
        $expenses_type  = AccountType::where('name->en', 'Expenses')->first();

        $accounts       = [
            [
                'name'              => 'Parent Supplies',
                'account_number'    => uniqid(),
                'account_type_id'   => $general_type->id,
                'notes'             => $faker->sentence(10),
                'company_code'      => $admin->company_code,
                'added_by'          => $admin->id,
            ],
            [
                'name'              => 'Capital',
                'account_number'    => uniqid(),
                'account_type_id'   => $captial_type->id,
                'notes'             => $faker->sentence(10),
                'company_code'      => $admin->company_code,
                'added_by'          => $admin->id,
            ],
            [
                'name'              => 'Phone & Internet Invoice',
                'account_number'    => uniqid(),
                'account_type_id'   => $expenses_type->id,
                'notes'             => $faker->sentence(10),
                'company_code'      => $admin->company_code,
                'added_by'          => $admin->id,
            ],
        ];

        foreach ($accounts as $account) {
            if (is_null(Account::where('name', $account['name'])->first()))
                Account::create($account);
        }
    }
}
