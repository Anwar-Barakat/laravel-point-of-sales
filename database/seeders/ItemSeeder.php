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
        $hand_too_cat   = Category::where('name->en', 'Hardware')->active()->first()->id;
        $meat_cat       = Category::where('name->en', 'Meat & Freezers')->active()->first()->id;
        $shoes_cat      = Category::where('name->en', 'Shoes')->active()->first()->id;
        $cotton_cat     = Category::where('name->en', 'Cottons')->active()->first()->id;
        $shirts_cat     = Category::where('name->en', 'Shirts')->active()->first()->id;
        $sachet_unit    = Unit::where('name->en', 'Sachet(25kg)')->active()->first()->id;
        $carton_unit    = Unit::where('name->en', 'Carton')->active()->first()->id;
        $box_unit       = Unit::where('name->en', 'Box')->active()->first()->id;
        $serial_unit    = Unit::where('name->en', 'Serial')->active()->first()->id;

        $items = [
            [
                'name'                              => 'Glass Cups',
                'barcode'                           => uniqid(),
                'type'                              => 1, // stored
                'category_id'                       => $hand_too_cat,
                'has_retail_unit'                   => true,
                'wholesale_unit_id'                 => $carton_unit,
                'wholesale_price'                   => 2000,
                'wholesale_price_for_half_block'    => 1900,
                'wholesale_price_for_block'         => 1850,
                'wholesale_cost_price'              => 1700,
                'retail_unit_id'                    => $box_unit,
                'retail_price'                      => 100,
                'retail_price_for_half_block'       => 90,
                'retail_price_for_block'            => 85,
                'retail_cost_price'                 => 70,
                'retail_count_for_wholesale'        => 20, // Carton contains 10 boxes
                'has_fixed_price'                   => rand(0, 1),
                'company_id'                        => $admin->company_id,
                'added_by'                          => $admin->id,
            ],
            [
                'name'                              => 'White Nike sneakers',
                'barcode'                           => uniqid(),
                'type'                              => 1, // stored
                'category_id'                       => $shoes_cat,
                'has_retail_unit'                   => true,
                'wholesale_unit_id'                 => $carton_unit,
                'wholesale_price'                   => 2000,
                'wholesale_price_for_half_block'    => 1900,
                'wholesale_price_for_block'         => 1850,
                'wholesale_cost_price'              => 1700,
                'retail_unit_id'                    => $box_unit,
                'retail_price'                      => 100,
                'retail_price_for_half_block'       => 90,
                'retail_price_for_block'            => 85,
                'retail_cost_price'                 => 70,
                'retail_count_for_wholesale'        => 20, // Carton contains 10 boxes
                'has_fixed_price'                   => rand(0, 1),
                'company_id'                        => $admin->company_id,
                'added_by'                          => $admin->id,
            ],
            [
                'name'                              => 'Black Nike sneakers',
                'barcode'                           => uniqid(),
                'type'                              => 1, // stored
                'category_id'                       => $shoes_cat,
                'has_retail_unit'                   => true,
                'wholesale_unit_id'                 => $carton_unit,
                'wholesale_price'                   => 2000,
                'wholesale_price_for_half_block'    => 1900,
                'wholesale_price_for_block'         => 1850,
                'wholesale_cost_price'              => 1700,
                'retail_unit_id'                    => $box_unit,
                'retail_price'                      => 85,
                'retail_price_for_half_block'       => 90,
                'retail_price_for_block'            => 100,
                'retail_cost_price'                 => 17,
                'retail_count_for_wholesale'        => 20, // Carton contains 10 boxes
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
                'wholesale_price'                   => 1200,
                'wholesale_price_for_half_block'    => 1100,
                'wholesale_price_for_block'         => 1000,
                'wholesale_cost_price'              => 900,
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
                'wholesale_price'                   => 1200,
                'wholesale_price_for_half_block'    => 1100,
                'wholesale_price_for_block'         => 1000,
                'wholesale_cost_price'              => 900,
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
                'wholesale_price'                   => 1200,
                'wholesale_price_for_half_block'    => 1100,
                'wholesale_price_for_block'         => 1000,
                'wholesale_cost_price'              => 900,
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
                'wholesale_price'                   => 700,
                'wholesale_price_for_half_block'    => 600,
                'wholesale_price_for_block'         => 500,
                'wholesale_cost_price'              => 400,
                'has_fixed_price'                   => rand(0, 1),
                'company_id'                        => $admin->company_id,
                'added_by'                          => $admin->id,
            ],
            [
                'name'                              => 'Men White T-Shirt',
                'barcode'                           => uniqid(),
                'type'                              => 1, // stored
                'category_id'                       => $shirts_cat,
                'has_retail_unit'                   => true,
                'wholesale_unit_id'                 => $carton_unit,
                'wholesale_price'                   => 50,
                'wholesale_price_for_half_block'    => 55,
                'wholesale_price_for_block'         => 60,
                'wholesale_cost_price'              => 40,
                'retail_unit_id'                    => $serial_unit,
                'retail_price'                      => 5,
                'retail_price_for_half_block'       => 5.5,
                'retail_price_for_block'            => 6,
                'retail_cost_price'                 => 4,
                'retail_count_for_wholesale'        => 10, // Carton contains 10 boxes
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
