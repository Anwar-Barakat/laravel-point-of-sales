<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $admin          = Admin::where('email', 'admin@admin.com')->first();
        $اouseware_cat  = Category::where('name->en', 'Houseware')->active()->first()->id;
        $unit           = Unit::inRandomOrder()->active()->first();

        return [
            'name'                              => 'أكواب عصير',
            'type'                              => 1, // stored
            'category_id'                       => $اouseware_cat,
            'has_retail_unit'                   => 0,
            'wholesale_unit_id'                 => $unit->id,
            'wholesale_price'                   => $this->faker->numberBetween(0, 500),
            'wholesale_price_for_block'         => $this->faker->numberBetween(1000, 1100),
            'wholesale_price_for_half_block'    => $this->faker->numberBetween(900, 1000),
            'wholesale_cost_price'              => $this->faker->numberBetween(800, 900),
            'has_fixed_price'                   => rand(0, 1),
            'company_id'                      => $admin->company->id,
            'added_by'                          => $admin->id,
        ];
    }
}
