<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Setting;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker      = Factory::create();
        $admin      = Admin::where('email', 'admin@admin.com')->first();

        $settings   = [
            [
                'company_name'      => [
                    'ar'    => 'حلول للكمبيوتر',
                    'en'    => 'Computer Solving',
                ],
                'company_code'          => $admin->company_code,
                'alert_msg'             => $faker->sentence(10),
                'address'               => $faker->address(),
                'mobile'                => $faker->phoneNumber(),
                'customer_account_id'   => 1,
                'vendor_account_id'     => 2,
                'added_by'              => $admin->id,
                'updated_by'            => $admin->id,
            ]
        ];

        foreach ($settings as $setting) {
            if (is_null(Setting::where('company_name->en', $setting['company_name']['en'])->orWhere('company_name->ar', $setting['company_name']['ar'])->first()))
                Setting::create($setting);
        }
    }
}
