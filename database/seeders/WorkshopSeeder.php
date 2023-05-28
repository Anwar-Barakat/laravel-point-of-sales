<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AccountType;
use App\Models\Admin;
use App\Models\Workshop;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkshopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker      = Factory::create();
        $admin      = Admin::where('email', 'admin@admin.com')->first();

        DB::table('workshops')->delete();

        $customer1 = Workshop::create([
            'name'                      => 'Workshop of women\'s t-shirts',
            'email'                     => 'workshop01@gmail.com',
            'address'                   => $faker->address(),
            'mobile'                    => $faker->phoneNumber(),
            'initial_balance_status'    => 1, // balanced
            'notes'                     => $faker->sentence(10),
            'company_id'                => $admin->id,
        ]);

        Account::create([
            'name'                      => 'Workshop of women\'s t-shirts',
            'account_type_id'           => AccountType::where('name->en', 'workshop')->first()->id,
            'is_parent'                 => 0,
            'parent_id'                 => $admin->company->parent_workshop_id,
            'number'                    => uniqid(),
            'initial_balance_status'    => 1, // balanced
            'notes'                     => $faker->sentence(10),
            'company_id'                => $admin->company->id,
            'workshop_id'               => $customer1->id,
        ]);

        $customer2 = Workshop::create([
            'name'                      => 'Workshop of men\'s t-shirts',
            'email'                     => 'workshop02@gmail.com',
            'address'                   => $faker->address(),
            'mobile'                    => $faker->phoneNumber(),
            'initial_balance_status'    => 1, // balanced
            'notes'                     => $faker->sentence(10),
            'company_id'                => $admin->id,
        ]);

        Account::create([
            'name'                      => 'Workshop of men\'s t-shirts',
            'account_type_id'           => AccountType::where('name->en', 'workshop')->first()->id,
            'is_parent'                 => 0,
            'parent_id'                 => $admin->company->parent_workshop_id,
            'number'                    => uniqid(),
            'initial_balance_status'    => 1, // balanced
            'notes'                     => $faker->sentence(10),
            'company_id'                => $admin->company->id,
            'workshop_id'               => $customer2->id,
        ]);

        $customer3 = Workshop::create([
            'name'                      => 'Workshop of children\'s t-shirts',
            'email'                     => 'workshop03@gmail.com',
            'address'                   => $faker->address(),
            'mobile'                    => $faker->phoneNumber(),
            'initial_balance_status'    => 1, // balanced
            'notes'                     => $faker->sentence(10),
            'company_id'                => $admin->id,
        ]);

        Account::create([
            'name'                      => 'Workshop of men\'s t-shirts',
            'account_type_id'           => AccountType::where('name->en', 'workshop')->first()->id,
            'is_parent'                 => 0,
            'parent_id'                 => $admin->company->parent_workshop_id,
            'number'                    => uniqid(),
            'initial_balance_status'    => 1, // balanced
            'notes'                     => $faker->sentence(10),
            'company_id'                => $admin->company->id,
            'workshop_id'               => $customer3->id,
        ]);
    }
}