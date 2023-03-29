<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin      = Admin::inRandomOrder()->first();
        $sections   = [
            [
                'name'          => [
                    'en'        => 'Men',
                    'ar'        => "رجال",
                ],
                'added_by'      => $admin->id,
                'updated_by'    => $admin->id,
            ],
            [
                'name'          => [
                    'en'        => 'Women',
                    'ar'        => 'نساء',
                ],
                'added_by'      => $admin->id,
                'updated_by'    => $admin->id,
            ],
            [
                'name'          => [
                    'en'        => 'Appliances',
                    'ar'        => 'أجهزة وأدوات',
                ],
                'added_by'      => $admin->id,
                'updated_by'    => $admin->id,
            ],
        ];

        foreach ($sections as $section) {
            if (is_null(Section::where('name->en', $section['name']['en'])->where('name->ar', $section['name']['ar'])->first()))
                Section::create($section);
        }
    }
}
