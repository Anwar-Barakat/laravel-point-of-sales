<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
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
        $admin      = Admin::inRandomOrder()->first();
        $categories = [
            [
                'name'          => [
                    'ar'    => 'احذية',
                    'en'    => 'Shoes',
                ],
                'company_code'  => $admin->company_code,
                'added_by'      => $admin->id,
                'updated_by'    => $admin->id,
            ],
            [
                'name'          => [
                    'ar'    => 'قمصان',
                    'en'    => 'Shirts',
                ],
                'company_code'  => $admin->company_code,
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
