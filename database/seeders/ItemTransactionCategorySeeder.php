<?php

namespace Database\Seeders;

use App\Models\ItemTransactionCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemTransactionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $categories   = [
            [
                'id'            => 1,
                'name'          => [
                    'en'        => 'Transaction on purchases',
                    'ar'        => "حركة على المشتريات",
                ],
            ],
            [
                'id'            => 2,
                'name'          => [
                    'en'        => 'Traffic on sales',
                    'ar'        => 'حركة على المبيعات',
                ],
            ],
            [
                'id'            => 3,
                'name'          => [
                    'en'        => 'Transaction on stores',
                    'ar'        => 'حركة على المخازن',
                ],
            ],
        ];

        foreach ($categories as $category) {
            if (is_null(ItemTransactionCategory::where('name->en', $category['name']['en'])->where('name->ar', $category['name']['ar'])->first()))
                ItemTransactionCategory::create($category);
        }
    }
}