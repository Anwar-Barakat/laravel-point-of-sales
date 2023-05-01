<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Delegate;
use App\Models\Sale;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker      = Factory::create();
        $admin      = Admin::where('email', 'admin@admin.com')->first();
        $customer   = Customer::inRandomOrder()->first();

        DB::table('sales')->delete();

        Sale::create([
            'customer_id'   => $customer->id,
            'delegate_id'   => Delegate::inRandomOrder()->first()->id,
            'invoice_type'  => $faker->randomElement([0, 1]), // cash
            'invoice_date'  => date('Y-m-d'),
            'category_id'   => Category::inRandomOrder()->first()->id,
            'notes'         => $faker->sentence(20),
            'account_id'    => $customer->account->id,
            'added_by'      => $admin->id,
            'company_code'  => $admin->company_code,
        ]);
    }
}