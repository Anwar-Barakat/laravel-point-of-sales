<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AccountType;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Vendor;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker      = Factory::create();
        $category   = Category::inRandomOrder()->active()->first();
        $admin      = Admin::where('email', 'admin@admin.com')->first();

        DB::table('vendors')->delete();

        $vendor = Vendor::create([
            'name'                      => 'Vendor 1',
            'address'                   => $faker->address(),
            'initial_balance_status'    => 1, // balanced
            'category_id'               => $category->id,
            'notes'                     => $faker->sentence(10),
            'company_code'              => $admin->id,
            'added_by'                  => $admin->company_code,
        ]);

        Account::create([
            'name'                      => 'Vendor 1',
            'account_type_id'           => AccountType::where('name->en', 'Vendor')->first()->id,
            'is_parent'                 => 0,
            'parent_id'                 => Setting::where('company_code', $admin->company_code)->first()->vendor_account_id,
            'number'                    => uniqid(),
            'initial_balance_status'    => 1, // balanced
            'notes'                     => $faker->sentence(10),
            'company_code'              => $admin->company_code,
            'added_by'                  => $admin->id,
            'vendor_id'                 => $vendor->id,
        ]);


        $vendor = Vendor::create([
            'name'                      => 'Vendor 2',
            'address'                   => $faker->address(),
            'initial_balance_status'    => 1, // balanced
            'category_id'               => $category->id,
            'notes'                     => $faker->sentence(10),
            'company_code'              => $admin->id,
            'added_by'                  => $admin->company_code,
        ]);

        Account::create([
            'name'                      => 'Vendor 2',
            'account_type_id'           => AccountType::where('name->en', 'Vendor')->first()->id,
            'is_parent'                 => 0,
            'parent_id'                 => Setting::where('company_code', $admin->company_code)->first()->vendor_account_id,
            'number'                    => uniqid(),
            'initial_balance_status'    => 1, // balanced
            'notes'                     => $faker->sentence(10),
            'company_code'              => $admin->company_code,
            'added_by'                  => $admin->id,
            'vendor_id'                 => $vendor->id,
        ]);
    }
}