<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Shift;
use App\Models\Treasury;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::where('email', 'admin@admin.com')->first();

        Shift::create([
            'treasury_id'   => Treasury::inRandomOrder()->first()->id,
            'admin_id'      => $admin->id,
            'company_code'  => $admin->company_code,
        ]);
    }
}
