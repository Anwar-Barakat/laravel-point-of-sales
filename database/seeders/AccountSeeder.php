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
                'number'            => 1,
                'account_type_id'   => $general_type->id,
                'notes'             => $faker->sentence(10),
                'company_id'      => $admin->company->id,
                'added_by'          => $admin->id,
            ],
            [
                'name'              => 'Parent Supplies',
                'number'            => 2,
                'account_type_id'   => $general_type->id,
                'notes'             => $faker->sentence(10),
                'company_id'      => $admin->company->id,
                'added_by'          => $admin->id,
            ],
            [
                'name'              => 'Capital',
                'number'            => 3,
                'account_type_id'   => $captial_type->id,
                'notes'             => $faker->sentence(10),
                'company_id'      => $admin->company->id,
                'added_by'          => $admin->id,
            ],
            [
                'name'              => 'Phone & Internet Invoices',
                'number'            => 4,
                'account_type_id'   => $expenses_type->id,
                'notes'             => $faker->sentence(10),
                'company_id'      => $admin->company->id,
                'added_by'          => $admin->id,
            ],
            [
                'name'              => 'Banks',
                'number'            => 5,
                'account_type_id'   => $general_type->id,
                'notes'             => $faker->sentence(10),
                'company_id'      => $admin->company->id,
                'added_by'          => $admin->id,
            ],
            [
                'name'              => 'Expenses',
                'number'            => 6,
                'account_type_id'   => $general_type->id,
                'notes'             => $faker->sentence(10),
                'company_id'      => $admin->company->id,
                'added_by'          => $admin->id,
            ],
            [
                'name'              => 'Islamic Bank',
                'number'            => 7,
                'is_parent'         => 0,
                'parent_id'         => 6, // Banks
                'account_type_id'   => $bank_type->id,
                'notes'             => $faker->sentence(10),
                'company_id'      => $admin->company->id,
                'added_by'          => $admin->id,
            ],

            [
                'name'              => 'Water Invoices',
                'number'            => 8,
                'is_parent'         => 0,
                'parent_id'         => 7, // Expenses
                'account_type_id'   => $general_type->id,
                'notes'             => $faker->sentence(10),
                'company_id'      => $admin->company->id,
                'added_by'          => $admin->id,
            ],
            [
                'name'              => 'Parent Delegates',
                'number'            => 9,
                'account_type_id'   => $general_type->id,
                'notes'             => $faker->sentence(10),
                'company_id'        => $admin->company->id,
                'added_by'          => $admin->id,
            ],
        ];

        foreach ($accounts as $account) {
            if (is_null(Account::where('name', $account['name'])->first()))
                Account::create($account);
        }
    }
}