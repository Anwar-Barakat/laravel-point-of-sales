<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\ProductionLine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductionLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin      = Admin::where('email', 'admin@admin.com')->first();
        $productions   = [
            [
                'plan'          => 'Production of glassware',
                'plan_date'     => date('Y-m-d'),
                'added_by'      => $admin->id,
                'company_id'    => $admin->company_id,
            ],
            [
                'plan'          => 'Production of clothing',
                'plan_date'     => date('Y-m-d'),
                'added_by'      => $admin->id,
                'company_id'    => $admin->company_id,
            ],
        ];

        foreach ($productions as $production) {
            if (is_null(ProductionLine::where('plan', $production['plan'])->first()))
                ProductionLine::create($production);
        }
    }
}
