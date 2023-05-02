<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AccountType;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Setting;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker      = Factory::create();
        $admin      = Admin::where('email', 'admin@admin.com')->first();

        DB::table('customers')->delete();

        $customer = Customer::create([
            'name'                      => 'customer 1',
            'address'                   => $faker->address(),
            'initial_balance_status'    => 1, // balanced
            'notes'                     => $faker->sentence(10),
            'company_id'              => $admin->id,
            'added_by'                  => $admin->company->id,
        ]);

        Account::create([
            'name'                      => 'customer 1',
            'account_type_id'           => AccountType::where('name->en', 'customer')->first()->id,
            'is_parent'                 => 0,
            'parent_id'                 => $admin->company->customer_account_id,
            'number'                    => uniqid(),
            'initial_balance_status'    => 1, // balanced
            'notes'                     => $faker->sentence(10),
            'company_id'              => $admin->company->id,
            'added_by'                  => $admin->id,
            'customer_id'               => $customer->id,
        ]);
    }
}
