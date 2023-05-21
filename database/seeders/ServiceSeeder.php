<?php

namespace Database\Seeders;

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
        $services = [
            [
                'name'          => 'Print',
                'type'          => 1,
                'company_id'    => get_auth_com(),
            ],
        ];

        foreach ($services as $service) {
            if (is_null(Service::where('name', $service['name'])->first()))
                Service::create($service);
        }
    }
}
