<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AccountType;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Delegate;
use App\Models\Setting;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DelegateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker      = Factory::create();
        $category   = Category::inRandomOrder()->active()->first();
        $admin      = Admin::where('email', 'admin@admin.com')->first();

        DB::table('delegates')->delete();

        $delegate = Delegate::create([
            'name'                      => 'delegate 1',
            'email'                     => 'delegate01@gmail.com',
            'address'                   => $faker->address(),
            'initial_balance_status'    => 1, // balanced
            'category_id'               => $category->id,
            'notes'                     => $faker->sentence(10),
            'company_id'                => $admin->id,
            'added_by'                  => $admin->company->id,
        ]);

        Account::create([
            'name'                      => 'Delegate 1',
            'account_type_id'           => AccountType::where('name->en', 'delegate')->first()->id,
            'is_parent'                 => 1,
            'parent_id'                 => 0,
            'parent_id'                 => $admin->company->parent_delegate_id, // Parent Delegates
            'number'                    => uniqid(),
            'initial_balance_status'    => 1, // balanced
            'notes'                     => $faker->sentence(10),
            'company_id'                => $admin->company->id,
            'added_by'                  => $admin->id,
            'delegate_id'               => $delegate->id,
        ]);
    }
}
