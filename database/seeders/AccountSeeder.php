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
        $admin          = Admin::where('email', 'admin@admin.com')->first();
        $captial_type   = AccountType::where('name->en', 'Capital')->first();
        $general_type   = AccountType::where('name->en', 'General')->first();
        $expenses_type  = AccountType::where('name->en', 'Expenses')->first();
        $bank_type      = AccountType::where('name->en', 'Bank')->first();

        $accounts       = [
            [
                'name'              => 'Parent Customers',
                'number'            => uniqid(),
                'account_type_id'   => $general_type->id,
                'notes'             => $faker->sentence(10),
                'company_code'      => $admin->company_code,
                'added_by'          => $admin->id,
            ],
            [
                'name'              => 'Parent Supplies',
                'number'            => uniqid(),
                'account_type_id'   => $general_type->id,
                'notes'             => $faker->sentence(10),
                'company_code'      => $admin->company_code,
                'added_by'          => $admin->id,
            ],
            [
                'name'              => 'Capital',
                'number'            => uniqid(),
                'account_type_id'   => $captial_type->id,
                'notes'             => $faker->sentence(10),
                'company_code'      => $admin->company_code,
                'added_by'          => $admin->id,
            ],
            [
                'name'              => 'Phone & Internet Invoice',
                'number'            => uniqid(),
                'account_type_id'   => $expenses_type->id,
                'notes'             => $faker->sentence(10),
                'company_code'      => $admin->company_code,
                'added_by'          => $admin->id,
            ],
            [
                'name'              => 'Bank Account',
                'number'            => uniqid(),
                'account_type_id'   => $general_type->id,
                'notes'             => $faker->sentence(10),
                'company_code'      => $admin->company_code,
                'added_by'          => $admin->id,
            ],
            [
                'name'              => 'Islamic Bank',
                'number'            => uniqid(),
                'is_parent'         => 0,
                'parent_id'         => 5,
                'account_type_id'   => $bank_type->id,
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
