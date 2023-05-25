<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Admin;
use App\Models\Company;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker      = Factory::create();
        $admin      = Admin::where('email', 'admin@admin.com')->first();

        DB::table('companies')->delete();

        Company::create([
            'name'      => [
                'ar'    => 'حلول للكمبيوتر',
                'en'    => 'Computer Solving',
            ],
            'email'                         => 'company@gmail.com',
            'alert_msg'                     => $faker->sentence(10),
            'address'                       => $faker->address(),
            'mobile'                        => $faker->phoneNumber(),
            'admin_id'                      => $admin->id,
            'parent_customer_id'            => 1,
            'parent_vendor_id'              => 2,
            'parent_delegate_id'            => 3,
            'parent_production_line_id'     => 10,
        ]);
    }
}