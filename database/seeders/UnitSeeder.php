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
                'company_id'  => $admin->company->id,
                'added_by'      => $admin->id,
            ],
            [
                'name'          => [
                    'en'        => 'Gram',
                    'ar'        => 'الغرام'
                ],
                'status'        => 'retail',
                'company_id'  => $admin->company->id,
                'added_by'      => $admin->id,
            ],
            [
                'name'          => [
                    'en'        => 'Liter',
                    'ar'        => 'اللتر'
                ],
                'status'        => 'retail',
                'company_id'  => $admin->company->id,
                'added_by'      => $admin->id,
            ],
            [
                'name'          => [
                    'en'        => 'Dozen',
                    'ar'        => 'الدرزن'
                ],
                'status'        => 'wholesale',
                'company_id'  => $admin->company->id,
                'added_by'      => $admin->id,
            ],
            [
                'name'          => [
                    'en'        => '1 Kilogram Platter',
                    'ar'        => 'طبق ١ كيلوغرام'
                ],
                'status'        => 'retail',
                'company_id'  => $admin->company->id,
                'added_by'      => $admin->id,
            ],
            [
                'name'          => [
                    'en'        => '90g Platter',
                    'ar'        => 'طبق ٩٠ غرام'
                ],
                'status'        => 'retail',
                'company_id'  => $admin->company->id,
                'added_by'      => $admin->id,
            ],
            [
                'name'          => [
                    'en'        => 'Cup Carton',
                    'ar'        => 'كرتونة الأكواب'
                ],
                'status'        => 'wholesale',
                'company_id'  => $admin->company->id,
                'added_by'      => $admin->id,
            ],
            [
                'name'          => [
                    'en'        => 'Box',
                    'ar'        => 'علبة'
                ],
                'status'        => 'retail',
                'company_id'  => $admin->company->id,
                'added_by'      => $admin->id,
            ],
            [
                'name'          => [
                    'en'        => 'Sachet',
                    'ar'        => 'الكيس'
                ],
                'status'        => 'wholesale',
                'company_id'  => $admin->company->id,
                'added_by'      => $admin->id,
            ],
        ];

        foreach ($units as $unit) {
            if (is_null(Unit::where('name->en', $unit['name']['en'])->where('name->ar', $unit['name']['ar'])->first()))
                Unit::create($unit);
        }
    }
}
