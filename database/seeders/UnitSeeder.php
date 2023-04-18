<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin      = Admin::where('email', 'admin@admin.com')->first();
        $units      = [
            [
                'name'          => [
                    'en'        => 'Kilogram',
                    'ar'        => 'كيلوغرام'
                ],
                'status'        => 'retail',
                'company_code'  => $admin->company_code,
                'added_by'      => $admin->id,
            ],
            [
                'name'          => [
                    'en'        => 'Gram',
                    'ar'        => 'الغرام'
                ],
                'status'        => 'retail',
                'company_code'  => $admin->company_code,
                'added_by'      => $admin->id,
            ],
            [
                'name'          => [
                    'en'        => 'Liter',
                    'ar'        => 'اللتر'
                ],
                'status'        => 'retail',
                'company_code'  => $admin->company_code,
                'added_by'      => $admin->id,
            ],
            [
                'name'          => [
                    'en'        => 'Box',
                    'ar'        => 'العلبة'
                ],
                'status'        => 'wholesale',
                'company_code'  => $admin->company_code,
                'added_by'      => $admin->id,
            ],
            [
                'name'          => [
                    'en'        => 'Dozen',
                    'ar'        => 'الدرزن'
                ],
                'status'        => 'wholesale',
                'company_code'  => $admin->company_code,
                'added_by'      => $admin->id,
            ],
        ];

        foreach ($units as $unit) {
            if (is_null(Unit::where('name->en', $unit['name']['en'])->where('name->ar', $unit['name']['ar'])->first()))
                Unit::create($unit);
        }
    }
}
