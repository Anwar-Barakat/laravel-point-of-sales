<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Treasury;
use App\Models\TreasuryDelivery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TreasuryDeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('treasury_deliveries')->truncate();

        $admin      = Admin::where('email', 'admin@admin.com')->first();
        $treasuries = [
            [
                'treasury_id'           => Treasury::where('is_master', 1)->first()->id,
                'treasury_delivery_id'  => Treasury::where('is_master', 0)->first()->id,
                'added_by'              => $admin->id,
                'updated_by'            => $admin->id,
                'company_code'          => $admin->company_code,
            ]
        ];

        foreach ($treasuries as $treasury) {
            TreasuryDelivery::create($treasury);
        }
    }
}
