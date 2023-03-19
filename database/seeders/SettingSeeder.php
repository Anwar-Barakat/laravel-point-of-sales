<?php

namespace Database\Seeders;

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
                'system_name'       => [
                    'ar'    => 'حلول للكمبيوتر',
                    'en'    => 'Computer Solving',
                ],
                'general_alert'     => $faker->sentence(10),
                'address'           => $faker->address(),
                'mobile'            => $faker->phoneNumber(),
                'company_code'      => 1,
                'is_active'         => true
            ]
        ];

        foreach ($settings as $setting) {
            if (is_null(Setting::where('system_name->en', $setting['system_name']['en'])->first()))
                Setting::create($setting);
        }
    }
}
