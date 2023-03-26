<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\InvoiceCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class InvoiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin      = Admin::inRandomOrder()->first();
        $categories = [
            [
                'name'          => [
                    'ar'    => 'لحوم مثلجة',
                    'en'    => 'Refrigerated meat',
                ],
                'company_code'  => $admin->company_code,
                'added_by'      => $admin->id,
                'updated_by'    => $admin->id,
                'is_active'     => true
            ]
        ];

        foreach ($categories as $cat) {
            if (is_null(InvoiceCategory::where('name->en', $cat['name']['en'])->orWhere('name->ar', $cat['name']['ar'])->first()))
                InvoiceCategory::create($cat);
        }
    }
}
