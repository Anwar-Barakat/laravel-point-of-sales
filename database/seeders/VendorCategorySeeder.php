<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Section;
use App\Models\VendorCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin      = Admin::inRandomOrder()->first();
        $sectionId  = Section::where('name->en', 'Men')->first()->id;

        $categories = [
            [
                'name'          => [
                    'ar'    => 'احذية',
                    'en'    => 'Shoes',
                ],
                'section_id'    => $sectionId,
                'company_code'  => $admin->company_code,
                'added_by'      => $admin->id,
            ],
        ];

        foreach ($categories as $cat) {
            if (is_null(VendorCategory::where('name->en', $cat['name']['en'])->orWhere('name->ar', $cat['name']['ar'])->first()))
                VendorCategory::create($cat);
        }
    }
}
