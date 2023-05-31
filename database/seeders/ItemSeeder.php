<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Item::factory(20)->create();
        $admin          = Admin::where('email', 'admin@admin.com')->first();
        $hand_too_cat   = Category::where('name->en', 'Hand Tools')->active()->first()->id;
        $meat_cat       = Category::where('name->en', 'Meat & Freezers')->active()->first()->id;
        $shoes_cat      = Category::where('name->en', 'Shoes')->active()->first()->id;
        $cotton_cat     = Category::where('name->en', 'Cottons')->active()->first()->id;
        $sachet_unit    = Unit::where('name->en', 'Sachet(25kg)')->active()->first()->id;
        $carton_unit    = Unit::where('name->en', 'Carton')->active()->first()->id;
        $box_unit       = Unit::where('name->en', 'Box')->active()->first()->id;

        $items = [
            [
                'name'                              => 'Glass Cups',
                'barcode'                           => uniqid(),
                'type'                              => 1, // stored
                'category_id'                       => $hand_too_cat,
                'has_retail_unit'                   => true,
                'wholesale_unit_id'                 => $carton_unit,
                'wholesale_price'                   => 900,
                'wholesale_price_for_half_block'    => 850,
                'wholesale_price_for_block'         => 800,
                'wholesale_cost_price'              => 17,
                'retail_unit_id'                    => $box_unit,
                'retail_price'                      => 90,
                'retail_price_for_half_block'       => 85,
                'retail_price_for_block'            => 80,
                'retail_cost_price'                 => 11,
                'retail_count_for_wholesale'        => 10, // Carton contains 10 boxes
                'has_fixed_price'                   => rand(0, 1),
                'company_id'                        => $admin->company_id,
                'added_by'                          => $admin->id,
            ],
            [
                'name'                              => 'Carton of white Nike sneakers',
                'barcode'                           => uniqid(),
                'type'                              => 1, // stored
                'category_id'                       => $shoes_cat,
                'has_retail_unit'                   => true,
                'wholesale_unit_id'                 => $carton_unit,
                'wholesale_price'                   => 1200,
                'wholesale_price_for_half_block'    => 1150,
                'wholesale_price_for_block'         => 1100,
                'wholesale_cost_price'              => 100,
                'retail_unit_id'                    => $box_unit,
                'retail_price'                      => 120,
                'retail_price_for_half_block'       => 115,
                'retail_price_for_block'            => 110,
                'retail_count_for_wholesale'        => 10, // Carton contains 10 boxes
                'retail_cost_price'                 => 15,
                'has_fixed_price'                   => rand(0, 1),
                'company_id'                        => $admin->company_id,
                'added_by'                          => $admin->id,
            ],
            [
                'name'                              => 'Carton of black Nike sneakers',
                'barcode'                           => uniqid(),
                'type'                              => 1, // stored
                'category_id'                       => $shoes_cat,
                'has_retail_unit'                   => true,
                'wholesale_unit_id'                 => $carton_unit,
                'wholesale_price'                   => 1200,
                'wholesale_price_for_half_block'    => 1150,
                'wholesale_price_for_block'         => 1100,
                'wholesale_cost_price'              => 100,
                'retail_unit_id'                    => $box_unit,
                'retail_price'                      => 120,
                'retail_price_for_half_block'       => 115,
                'retail_price_for_block'            => 110,
                'retail_count_for_wholesale'        => 10, // Carton contains 10 boxes
                'retail_cost_price'                 => 15,
                'has_fixed_price'                   => rand(0, 1),
                'company_id'                        => $admin->company_id,
                'added_by'                          => $admin->id,
            ],
            [
                'name'                              => 'Chicken Meat',
                'barcode'                           => uniqid(),
                'type'                              => 2, // consuming
                'category_id'                       => $meat_cat,
                'has_retail_unit'                   => false,
                'wholesale_unit_id'                 => $sachet_unit,
                'wholesale_price'                   => 900,
                'wholesale_price_for_half_block'    => 850,
                'wholesale_price_for_block'         => 800,
                'wholesale_cost_price'              => 18,
                'has_fixed_price'                   => rand(0, 1),
                'company_id'                        => $admin->company_id,
                'added_by'                          => $admin->id,
            ],
            [
                'name'                              => 'Lamb',
                'barcode'                           => uniqid(),
                'type'                              => 2, // consuming
                'category_id'                       => $meat_cat,
                'has_retail_unit'                   => false,
                'wholesale_unit_id'                 => $sachet_unit,
                'wholesale_price'                   => 1100,
                'wholesale_price_for_half_block'    => 1050,
                'wholesale_price_for_block'         => 1000,
                'wholesale_cost_price'              => 20,
                'has_fixed_price'                   => rand(0, 1),
                'company_id'                        => $admin->company_id,
                'added_by'                          => $admin->id,
            ],
            [
                'name'                              => 'Beef',
                'barcode'                           => uniqid(),
                'type'                              => 2, // consuming
                'category_id'                       => $meat_cat,
                'has_retail_unit'                   => false,
                'wholesale_unit_id'                 => $sachet_unit,
                'wholesale_price'                   => 1000,
                'wholesale_price_for_half_block'    => 950,
                'wholesale_price_for_block'         => 900,
                'wholesale_cost_price'              => 19,
                'has_fixed_price'                   => rand(0, 1),
                'company_id'                        => $admin->company_id,
                'added_by'                          => $admin->id,
            ],
            [
                'name'                              => 'Cottons',
                'barcode'                           => uniqid(),
                'type'                              => 1, // stored
                'category_id'                       => $cotton_cat,
                'has_retail_unit'                   => false,
                'wholesale_unit_id'                 => $sachet_unit,
                'wholesale_price'                   => 500,
                'wholesale_price_for_half_block'    => 450,
                'wholesale_price_for_block'         => 400,
                'wholesale_cost_price'              => 12,
                'has_fixed_price'                   => rand(0, 1),
                'company_id'                        => $admin->company_id,
                'added_by'                          => $admin->id,
            ],
        ];

        foreach ($items as $item) {
            if (is_null(Item::where('name', $item['name'])->first()))
                Item::create($item);
        }
    }
}
