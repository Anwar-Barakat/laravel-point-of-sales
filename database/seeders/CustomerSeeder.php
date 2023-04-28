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
            'name'                      => 'Customer 1',
            'address'                   => $faker->address(),
            'initial_balance_status'    => 1, // balanced
            'notes'                     => $faker->sentence(10),
            'company_code'              => $admin->id,
            'added_by'                  => $admin->company_code,
        ]);

        Account::create([
            'name'                      => 'Customer 1',
            'account_type_id'           => AccountType::where('name->en', 'Customer')->first()->id,
            'is_parent'                 => 0,
            'parent_id'                 => Setting::where('company_code', $admin->company_code)->first()->customer_account_id,
            'number'                    => uniqid(),
            'initial_balance_status'    => 1, // balanced
            'notes'                     => $faker->sentence(10),
            'company_code'              => $admin->company_code,
            'added_by'                  => $admin->id,
            'customer_id'               => $customer->id,
        ]);
    }
}