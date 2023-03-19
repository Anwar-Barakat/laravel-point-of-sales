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
        $settings   = [
            [
                'company_name'      => [
                    'ar'    => 'حلول للكمبيوتر',
                    'en'    => 'Computer Solving',
                ],
                'company_code'      => 1,
                'alert_msg'         => $faker->sentence(10),
                'address'           => $faker->address(),
                'mobile'            => $faker->phoneNumber(),
                'added_by'          => Admin::inRandomOrder()->first()->id,
                'updated_by'        => Admin::inRandomOrder()->first()->id,
                'is_active'         => true
            ]
        ];

        foreach ($settings as $setting) {
            if (is_null(Setting::where('company_name->en', $setting['company_name']['en'])->first()))
                Setting::create($setting);
        }
    }
}
