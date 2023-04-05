<?php

namespace Database\Seeders;

use App\Models\AccountType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $account_types  = [
            [
                'name'                          => [
                    'ar'                        => 'مورد',
                    'en'                        => 'Vendor'
                ],
                'related_to_internal_account'   => 1,
            ],
            [
                'name'                          => [
                    'ar'                        => 'عميل',
                    'en'                        => 'Customer'
                ],
                'related_to_internal_account'   => 1,
            ],
            [
                'name'                          => [
                    'ar'                        => 'مندوب',
                    'en'                        => 'Representative'
                ],
                'related_to_internal_account'   => 1,
            ],
            [
                'name'                          => [
                    'ar'                        => 'بنكي',
                    'en'                        => 'Bank'
                ],
                'related_to_internal_account'   => 0,
            ],
            [
                'name'                          => [
                    'ar'                        => 'موظف',
                    'en'                        => 'Employee'
                ],
                'related_to_internal_account'   => 1,
            ],
            [
                'name'                          => [
                    'ar'                        => 'عام',
                    'en'                        => 'General'
                ],
                'related_to_internal_account'   => 0,
            ],
            [
                'name'                          => [
                    'ar'                        => 'مصروفات',
                    'en'                        => 'Expenses'
                ],
                'related_to_internal_account'   => 0,
            ],
            [
                'name'                          => [
                    'ar'                        => 'قسم داخلي',
                    'en'                        => 'Internal Section'
                ],
                'related_to_internal_account'   => 1,
            ],
            [
                'name'                          => [
                    'ar'                        => 'رأس المال',
                    'en'                        => 'Capital'
                ],
                'related_to_internal_account'   => 0,
            ]
        ];

        foreach ($account_types as $account) {
            if (is_null(AccountType::where('name->en', $account['name']['en'])->where('name->ar', $account['name']['ar'])->first()))
                AccountType::create($account);
        }
    }
}