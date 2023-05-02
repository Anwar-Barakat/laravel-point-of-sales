<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Treasury;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TreasurySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin      = Admin::where('email', 'admin@admin.com')->first();
        $treasuries = [
            [
                'name'                  => 'Casher 1',
                'is_master'             => 1,
                'company_id'            => $admin->company->id,
                'admin_id'              => $admin->id,
            ],
            [
                'name'                  => 'Casher 2',
                'company_id'            => $admin->company->id,
                'admin_id'              => $admin->id,
            ],
            [
                'name'                  => 'Casher 3',
                'company_id'            => $admin->company->id,
                'admin_id'              => $admin->id,
            ],
        ];

        foreach ($treasuries as $treasury) {
            if (is_null(Treasury::where('name', $treasury['name'])->first()))
                Treasury::create($treasury);
        }
    }
}