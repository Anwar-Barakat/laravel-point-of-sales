<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Store;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fake   = Factory::create();
        $admin  = Admin::where('email', 'admin@admin.com')->first();

        $stores = [
            [
                'name'      => [
                    'ar'    => 'المخزن ١',
                    'en'    => 'Store 1',
                ],
                'address'   => $fake->address(),
                'mobile'    => $fake->phoneNumber(),
                'company_code'  => $admin->company_code,
                'added_by'      => $admin->id,
                'updated_by'    => $admin->id,
            ],
            [
                'name'      => [
                    'ar'    => 'المخزن ٢',
                    'en'    => 'Store 2',
                ],
                'address'   => $fake->address(),
                'mobile'    => $fake->phoneNumber(),
                'company_code'  => $admin->company_code,
                'added_by'      => $admin->id,
                'updated_by'    => $admin->id,
            ],
        ];

        foreach ($stores as $store) {
            if (is_null(Store::where('name->en', $store['name']['en'])->orWhere('name->ar', $store['name']['ar'])->first()))
                Store::create($store);
        }
    }
}
