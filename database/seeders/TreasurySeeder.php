<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Treasury;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TreasurySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin      = Admin::inRandomOrder()->first();
        $treasuries = [
            [
                'name'                  => 'Casher 1',
                'is_master'             => 1,
                'is_active'             => rand(1, 0),
                'last_payment_receipt'  => 1,
                'last_payment_collect'  => 1,
                'added_by'              => $admin->id,
                'updated_by'            => $admin->id,
                'company_code'          => $admin->company_code,
            ],
            [
                'name'                  => 'Casher 2',
                'is_master'             => 0,
                'is_active'             => rand(1, 0),
                'last_payment_receipt'  => 1,
                'last_payment_collect'  => 1,
                'added_by'              => $admin->id,
                'updated_by'            => $admin->id,
                'company_code'          => $admin->company_code,
            ],
        ];

        foreach ($treasuries as $treasury) {
            if (is_null(Treasury::where('name', $treasury['name'])->first()))
                Treasury::create($treasury);
        }
    }
}