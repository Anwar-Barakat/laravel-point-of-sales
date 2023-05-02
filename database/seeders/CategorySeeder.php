<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Section;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker          = Factory::create();
        $admin          = Admin::where('email', 'admin@admin.com')->first();
        $men_section    = Section::where('name->en', 'Men')->first()->id;
        $food_section   = Section::where('name->en', 'Foods')->first()->id;

        $categories = [
            [
                'name'          => [
                    'ar'    => 'احذية',
                    'en'    => 'Shoes',
                ],
                'company_id'  => $admin->company->id,
                'description'   => $faker->sentence(20),
                'parent_id'     => 0,
                'section_id'    => $men_section,
                'added_by'      => $admin->id,
                'updated_by'    => $admin->id,
            ],
            [
                'name'          => [
                    'ar'    => 'قمصان',
                    'en'    => 'Shirts',
                ],
                'company_id'  => $admin->company->id,
                'description'   => $faker->sentence(20),
                'parent_id'     => 0,
                'section_id'    => $men_section,
                'added_by'      => $admin->id,
                'updated_by'    => $admin->id,
            ],
            [
                'name'          => [
                    'ar'    => 'لحوم ومجمدات',
                    'en'    => 'Meat & Freezers',
                ],
                'company_id'  => $admin->company->id,
                'description'   => $faker->sentence(20),
                'parent_id'     => 0,
                'section_id'    => $food_section,
                'added_by'      => $admin->id,
                'updated_by'    => $admin->id,
            ],
            [
                'name'          => [
                    'ar'    => 'حبوب',
                    'en'    => 'Beans',
                ],
                'company_id'  => $admin->company->id,
                'description'   => $faker->sentence(20),
                'parent_id'     => 0,
                'section_id'    => $food_section,
                'added_by'      => $admin->id,
                'updated_by'    => $admin->id,
            ],
            [
                'name'          => [
                    'ar'    => 'مخللات',
                    'en'    => 'Pickles',
                ],
                'company_id'  => $admin->company->id,
                'description'   => $faker->sentence(20),
                'parent_id'     => 0,
                'section_id'    => $food_section,
                'added_by'      => $admin->id,
                'updated_by'    => $admin->id,
            ],
            [
                'name'          => [
                    'ar'    => 'الأدوات اليدوية',
                    'en'    => 'Hand Tools',
                ],
                'company_id'  => $admin->company->id,
                'description'   => $faker->sentence(20),
                'parent_id'     => 0,
                'section_id'    => $food_section,
                'added_by'      => $admin->id,
                'updated_by'    => $admin->id,
            ],
            [
                'name'          => [
                    'ar'    => 'الأجهزة المنزلية',
                    'en'    => 'Home Appliances',
                ],
                'company_id'  => $admin->company->id,
                'description'   => $faker->sentence(20),
                'parent_id'     => 0,
                'section_id'    => $food_section,
                'added_by'      => $admin->id,
                'updated_by'    => $admin->id,
            ],
        ];

        foreach ($categories as $cat) {
            if (is_null(Category::where('name->en', $cat['name']['en'])->orWhere('name->ar', $cat['name']['ar'])->first()))
                Category::create($cat);
        }
    }
}
