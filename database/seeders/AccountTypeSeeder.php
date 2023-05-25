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
        $admin          = Admin::where('email', 'admin@admin.com')->first();
        $account_types  = [
            [
                'name'                          => [
                    'ar'                        => 'مورد',
                    'en'                        => 'vendor'
                ],
                'related_to_internal_account'   => 1,
                'added_by'                      => $admin->id,
            ],
            [
                'name'                          => [
                    'ar'                        => 'عميل',
                    'en'                        => 'customer'
                ],
                'related_to_internal_account'   => 1,
                'added_by'                      => $admin->id,
            ],
            [
                'name'                          => [
                    'ar'                        => 'مندوب',
                    'en'                        => 'delegate'
                ],
                'related_to_internal_account'   => 1,
                'added_by'                      => $admin->id,
            ],
            [
                'name'                          => [
                    'ar'                        => 'بنكي',
                    'en'                        => 'bank'
                ],
                'related_to_internal_account'   => 0,
                'added_by'                      => $admin->id,
            ],
            [
                'name'                          => [
                    'ar'                        => 'خط إنتاج',
                    'en'                        => 'production_line'
                ],
                'related_to_internal_account'   => 1,
                'added_by'                      => $admin->id,
            ],
            [
                'name'                          => [
                    'ar'                        => 'عام',
                    'en'                        => 'general'
                ],
                'related_to_internal_account'   => 0,
                'added_by'                      => $admin->id,
            ],
            [
                'name'                          => [
                    'ar'                        => 'مصروفات',
                    'en'                        => 'expense'
                ],
                'related_to_internal_account'   => 0,
                'added_by'                      => $admin->id,
            ],
            [
                'name'                          => [
                    'ar'                        => 'قسم داخلي',
                    'en'                        => 'internal section'
                ],
                'related_to_internal_account'   => 1,
                'added_by'                      => $admin->id,
            ],
            [
                'name'                          => [
                    'ar'                        => 'رأس المال',
                    'en'                        => 'capital'
                ],
                'related_to_internal_account'   => 0,
                'added_by'                      => $admin->id,
            ],
            [
                'name'                          => [
                    'ar'                        => 'موظف',
                    'en'                        => 'employee'
                ],
                'related_to_internal_account'   => 0,
                'added_by'                      => $admin->id,
            ],
        ];

        foreach ($account_types as $account) {
            if (is_null(AccountType::where('name->en', $account['name']['en'])->where('name->ar', $account['name']['ar'])->first()))
                AccountType::create($account);
        }
    }
}
