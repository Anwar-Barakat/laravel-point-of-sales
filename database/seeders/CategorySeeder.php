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
        $faker      = Factory::create();
        $admin      = Admin::inRandomOrder()->first();
        $sectionId  = Section::where('name->en', 'Clothes')->first()->id;
        $categories = [
            [
                'name'          => [
                    'ar'    => 'احذية',
                    'en'    => 'Shoes',
                ],
                'company_code'  => $admin->company_code,
                'description'   => $faker->sentence(20),
                'parent_id'     => 0,
                'section_id'    => $sectionId,
                'added_by'      => $admin->id,
                'updated_by'    => $admin->id,
            ],
            [
                'name'          => [
                    'ar'    => 'قمصان',
                    'en'    => 'Shirts',
                ],
                'company_code'  => $admin->company_code,
                'description'   => $faker->sentence(20),
                'parent_id'     => 0,
                'section_id'    => $sectionId,
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
