<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin      = Admin::where('email', 'admin@admin.com')->first();
        $services   = [
            [
                'name'          => [
                    'ar'    => 'طباعة',
                    'en'    => 'Print'
                ],
                'type'          => 0,
                'company_id'    => $admin->company->id,
            ],
            [
                'name'          => [
                    'ar'    => 'تركيب كميرات',
                    'en'    => 'Placing Cameras'
                ],
                'type'          => 1,
                'company_id'    => $admin->company->id,
            ],

        ];

        foreach ($services as $service) {
            if (is_null(Service::where('name', $service['name'])->first()))
                Service::create($service);
        }
    }
}