<?php

namespace Database\Seeders;

use App\Models\AccountType;
use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin          = Admin::inRandomOrder()->first();
        $account_types  = [
            [
                'name'                          => [
                    'ar'                        => 'مورد',
                    'en'                        => 'Vendor'
                ],
                'related_to_internal_account'   => 1,
                'added_by'                      => $admin->id,
            ],
            [
                'name'                          => [
                    'ar'                        => 'عميل',
                    'en'                        => 'Customer'
                ],
                'related_to_internal_account'   => 1,
                'added_by'                      => $admin->id,
            ],
            [
                'name'                          => [
                    'ar'                        => 'مندوب',
                    'en'                        => 'Representative'
                ],
                'related_to_internal_account'   => 1,
                'added_by'                      => $admin->id,
            ],
            [
                'name'                          => [
                    'ar'                        => 'بنكي',
                    'en'                        => 'Bank'
                ],
                'related_to_internal_account'   => 0,
                'added_by'                      => $admin->id,
            ],
            [
                'name'                          => [
                    'ar'                        => 'موظف',
                    'en'                        => 'Employee'
                ],
                'related_to_internal_account'   => 1,
                'added_by'                      => $admin->id,
            ],
            [
                'name'                          => [
                    'ar'                        => 'عام',
                    'en'                        => 'General'
                ],
                'related_to_internal_account'   => 0,
                'added_by'                      => $admin->id,
            ],
            [
                'name'                          => [
                    'ar'                        => 'مصروفات',
                    'en'                        => 'Expenses'
                ],
                'related_to_internal_account'   => 0,
                'added_by'                      => $admin->id,
            ],
            [
                'name'                          => [
                    'ar'                        => 'قسم داخلي',
                    'en'                        => 'Internal Section'
                ],
                'related_to_internal_account'   => 1,
                'added_by'                      => $admin->id,
            ],
            [
                'name'                          => [
                    'ar'                        => 'رأس المال',
                    'en'                        => 'Capital'
                ],
                'related_to_internal_account'   => 0,
                'added_by'                      => $admin->id,
            ]
        ];

        foreach ($account_types as $account) {
            if (is_null(AccountType::where('name->en', $account['name']['en'])->where('name->ar', $account['name']['ar'])->first()))
                AccountType::create($account);
        }
    }
}
