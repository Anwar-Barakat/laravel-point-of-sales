<?php

namespace Database\Seeders;

use App\Models\AccountType;
use App\Models\ShiftType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShiftTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'id'                => 1,
                'name'              => [
                    'ar'            => 'مراجعة واستلام سندات الخزينة على نفس الخزنة',
                    'en'            => 'Review and receive shift treasuries on the same safe',
                ],
                'in_screen'         => 1,
                'account_type_id'   => AccountType::where(['name->en' => 'general'])->first()->id,
            ],
            [
                'id'                => 2,
                'name'              => [
                    'ar'            => 'مراجعة واستلام سندات الخزينة على خزينة أخرى',
                    'en'            => 'Review and receive treasury bonds on another treasury',
                ],
                'in_screen'         => 1,
                'account_type_id'   => AccountType::where(['name->en' => 'general'])->first()->id,
            ],
            [
                'id'                => 3,
                'name'              => [
                    'ar'            => 'صرف مبلغ لحساب مالي',
                    'en'            => 'Disbursement of an amount to a financial account',
                ],
                'in_screen'         => 0,
                'account_type_id'   => AccountType::where(['name->en' => 'general'])->first()->id,
            ],
            [
                'id'                => 4,
                'name'              => [
                    'ar'            => 'تحصيل مبلغ من حساب مالي',
                    'en'            => 'Collecting money from a financial account',
                ],
                'in_screen'         => 1,
                'account_type_id'   => AccountType::where(['name->en' => 'general'])->first()->id,
            ],
            [
                'id'                => 5,
                'name'              => [
                    'ar'            => 'تحصيل إيرادات مبيعات',
                    'en'            => 'Collection of sales revenue',
                ],
                'in_screen'         => 1,
                'account_type_id'   => AccountType::where(['name->en' => 'customer'])->first()->id,
            ],
            [
                'id'                => 6,
                'name'              => [
                    'ar'            => 'صرف نظير مرتجع مبيعات',
                    'en'            => 'Disbursement of sales returns',
                ],
                'in_screen'         => 0,
                'account_type_id'   => AccountType::where(['name->en' => 'customer'])->first()->id,
            ],
            [
                'id'                => 7,
                'name'              => [
                    'ar'            => 'صرف سلفة على راتب موظف',
                    'en'            => 'Disbursement of an advance on the salary of an employee',
                ],
                'in_screen'         => 0,
                'account_type_id'   => AccountType::where(['name->en' => 'employee'])->first()->id,
            ],
            [
                'id'                => 8,
                'name'              => [
                    'ar'            => 'صرف نظير فاتورة مشتريات من مورد',
                    'en'            => 'Disbursement for an invoice for purchases from a supplier',
                ],
                'in_screen'         => 0,
                'account_type_id'   => AccountType::where(['name->en' => 'vendor'])->first()->id,
            ],
            [
                'id'                => 9,
                'name'              => [
                    'ar'            => 'تحصيل نظير مرتجع مشتريات الى مورد',
                    'en'            => 'Collection of a return counterpart purchased to a supplier',
                ],
                'in_screen'         => 1,
                'account_type_id'   => AccountType::where(['name->en' => 'vendor'])->first()->id,
            ],
            [
                'id'                => 10,
                'name'              => [
                    'ar'            => 'إيراد زيادة رأس المال',
                    'en'            => 'Capital Increase Revenue',
                ],
                'in_screen'         => 1,
                'account_type_id'   => AccountType::where(['name->en' => 'capital'])->first()->id,
            ],
            [
                'id'                => 11,
                'name'              => [
                    'ar'            => 'استبدال وديعة بنكية',
                    'en'            => 'Exchange for a bank deposit',
                ],
                'in_screen'         => 0,
                'account_type_id'   => AccountType::where(['name->en' => 'bank'])->first()->id,
            ],
            [
                'id'                => 12,
                'name'              => [
                    'ar'            => 'استرداد سلفة على راتب الموظف',
                    'en'            => 'refund of an advance on the employee\'s salary',
                ],
                'in_screen'         => 1,
                'account_type_id'   => AccountType::where(['name->en' => 'employee'])->first()->id,
            ],
            [
                'id'                => 13,
                'name'              => [
                    'ar'            => 'تحصيل خصومات موظفين',
                    'en'            => 'Collecting employee discounts',
                ],
                'in_screen'         => 1,
                'account_type_id'   => AccountType::where(['name->en' => 'employee'])->first()->id,
            ],
            [
                'id'                => 14,
                'name'              => [
                    'ar'            => 'صرف مرتب للموظف',
                    'en'            => 'salary payment to the employee',
                ],
                'in_screen'         => 0,
                'account_type_id'   => AccountType::where(['name->en' => 'employee'])->first()->id,
            ],
            [
                'id'                => 15,
                'name'              => [
                    'ar'            => 'اقتراض من بنك',
                    'en'            => 'Borrowing from a bank',
                ],
                'in_screen'         => 1,
                'account_type_id'   => AccountType::where(['name->en' => 'bank'])->first()->id,
            ],
            [
                'id'                => 16,
                'name'              => [
                    'ar'            => 'صرف لرد رأس المال',
                    'en'            => 'Disbursement to refund capital',
                ],
                'in_screen'         => 0,
                'account_type_id'   => AccountType::where(['name->en' => 'capital'])->first()->id,
            ],
            [
                'id'                => 17,
                'name'              => [
                    'ar'            => 'صرف لفاتورة خدمات داخلية',
                    'en'            => 'Disbursement of an internal invoice',
                ],
                'in_screen'         => 0,
                'account_type_id'   => AccountType::where(['name->en' => 'general'])->first()->id,
            ],
            [
                'id'                => 18,
                'name'              => [
                    'ar'            => 'تحصيل مبلغ من فاتورة خدمات خارجية',
                    'en'            => 'Collecting money from an external invoice',
                ],
                'in_screen'         => 1,
                'account_type_id'   => AccountType::where(['name->en' => 'general'])->first()->id,
            ],
            [
                'id'                => 19,
                'name'              => [
                    'ar'            => 'صرف لفاتورة ورش عمل',
                    'en'            => 'Disbursement of an workshop invoice',
                ],
                'in_screen'         => 0,
                'account_type_id'   => AccountType::where(['name->en' => 'general'])->first()->id,
            ],
        ];

        foreach ($types as $type) {
            if (is_null(ShiftType::where('name->en', $type['name']['en'])->where('name->ar', $type['name']['ar'])->first()))
                ShiftType::create($type);
        }
    }
}