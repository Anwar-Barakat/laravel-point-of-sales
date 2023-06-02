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
        $faker          = Factory::create();
        $hand_too_cat   = Category::select('id')->where('name->en', 'Hardware')->active()->first()->id;
        $meat_cat       = Category::select('id')->where('name->en', 'Meat & Freezers')->active()->first()->id;
        $shoes_cat      = Category::select('id')->where('name->en', 'Shoes')->active()->first()->id;
        $cotton_cat     = Category::select('id')->where('name->en', 'Cottons')->active()->first()->id;
        $admin          = Admin::where('email', 'admin@admin.com')->first();

        DB::table('vendors')->delete();

        $vendor1 = Vendor::create([
            'name'                      => 'vendor 1',
            'email'                     => 'vendor01@gmail.com',
            'address'                   => $faker->address(),
            'initial_balance_status'    => 1, // balanced
            'category_id'               => $hand_too_cat,
            'notes'                     => $faker->sentence(10),
            'company_id'                => $admin->company_id,
        ]);

        Account::create([
            'name'                      => 'vendor 1',
            'account_type_id'           => AccountType::where('name->en', 'vendor')->first()->id,
            'is_parent'                 => 0,
            'parent_id'                 => $admin->company->parent_vendor_id,
            'number'                    => uniqid(),
            'initial_balance_status'    => 1, // balanced
            'notes'                     => $faker->sentence(10),
            'company_id'                => $admin->company_id,
            'vendor_id'                 => $vendor1->id,
        ]);


        $vendor2 = Vendor::create([
            'name'                      => 'vendor 2',
            'email'                     => 'vendor02@gmail.com',
            'address'                   => $faker->address(),
            'initial_balance_status'    => 1, // balanced
            'category_id'               => $meat_cat,
            'notes'                     => $faker->sentence(10),
            'company_id'                => $admin->company_id,
        ]);

        Account::create([
            'name'                      => 'vendor 2',
            'account_type_id'           => AccountType::where('name->en', 'vendor')->first()->id,
            'is_parent'                 => 0,
            'parent_id'                 => $admin->company->parent_vendor_id,
            'number'                    => uniqid(),
            'initial_balance_status'    => 1, // balanced
            'notes'                     => $faker->sentence(10),
            'company_id'                => $admin->company_id,
            'vendor_id'                 => $vendor2->id,
        ]);

        $vendor3 = Vendor::create([
            'name'                      => 'vendor 3',
            'email'                     => 'vendor03@gmail.com',
            'address'                   => $faker->address(),
            'initial_balance_status'    => 1, // balanced
            'category_id'               => $shoes_cat,
            'notes'                     => $faker->sentence(10),
            'company_id'                => $admin->company_id,
        ]);

        Account::create([
            'name'                      => 'vendor 3',
            'account_type_id'           => AccountType::where('name->en', 'vendor')->first()->id,
            'is_parent'                 => 0,
            'parent_id'                 => $admin->company->parent_vendor_id,
            'number'                    => uniqid(),
            'initial_balance_status'    => 1, // balanced
            'notes'                     => $faker->sentence(10),
            'company_id'                => $admin->company_id,
            'vendor_id'                 => $vendor3->id,
        ]);

        $vendor3 = Vendor::create([
            'name'                      => 'vendor 4',
            'email'                     => 'vendor04@gmail.com',
            'address'                   => $faker->address(),
            'initial_balance_status'    => 1, // balanced
            'category_id'               => $cotton_cat,
            'notes'                     => $faker->sentence(10),
            'company_id'                => $admin->company_id,
        ]);

        Account::create([
            'name'                      => 'vendor 4',
            'account_type_id'           => AccountType::where('name->en', 'vendor')->first()->id,
            'is_parent'                 => 0,
            'parent_id'                 => $admin->company->parent_vendor_id,
            'number'                    => uniqid(),
            'initial_balance_status'    => 1, // balanced
            'notes'                     => $faker->sentence(10),
            'company_id'                => $admin->company_id,
            'vendor_id'                 => $vendor3->id,
        ]);
    }
}
