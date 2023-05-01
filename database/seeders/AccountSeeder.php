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
        $captial_type   = AccountType::where('name->en', 'capital')->first();
        $general_type   = AccountType::where('name->en', 'general')->first();
        $expenses_type  = AccountType::where('name->en', 'expenses')->first();
        $bank_type      = AccountType::where('name->en', 'bank')->first();

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
                'name'              => 'Phone & Internet Invoices',
                'number'            => uniqid(),
                'account_type_id'   => $expenses_type->id,
                'notes'             => $faker->sentence(10),
                'company_code'      => $admin->company_code,
                'added_by'          => $admin->id,
            ],
            [
                'name'              => 'Banks',
                'number'            => uniqid(),
                'account_type_id'   => $general_type->id,
                'notes'             => $faker->sentence(10),
                'company_code'      => $admin->company_code,
                'added_by'          => $admin->id,
            ],
            [
                'name'              => 'Expenses',
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
                'parent_id'         => 6, // Banks
                'account_type_id'   => $bank_type->id,
                'notes'             => $faker->sentence(10),
                'company_code'      => $admin->company_code,
                'added_by'          => $admin->id,
            ],

            [
                'name'              => 'Water Invoices',
                'number'            => uniqid(),
                'is_parent'         => 0,
                'parent_id'         => 7, // Expenses
                'account_type_id'   => $general_type->id,
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