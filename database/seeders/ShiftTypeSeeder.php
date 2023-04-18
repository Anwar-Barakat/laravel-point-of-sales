<?php

namespace Database\Seeders;

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
                'name'          => [
                    'ar'        => 'مراجعة واستلام سندات الخزينة على نفس الخزنة',
                    'en'        => 'Review and receive shift treasuries on the same safe',
                ],
                'in_screen'     => 1,
            ],
            [
                'name'          => [
                    'ar'        => 'مراجعة واستلام سندات الخزينة على خزينة أخرى',
                    'en'        => 'Review and receive treasury bonds on another treasury',
                ],
                'in_screen'     => 1,
            ],
            [
                'name'          => [
                    'ar'        => 'صرف مبلغ لحساب مالي',
                    'en'        => 'Disbursement of an amount to a financial account',
                ],
                'in_screen'     => 1,
            ],
            [
                'name'          => [
                    'ar'        => 'تحصيل مبلغ من حساب مالي',
                    'en'        => 'Collecting money from a financial account',
                ],
                'in_screen'     => 1,
            ],
            [
                'name'          => [
                    'ar'        => 'تحصيل إيرادات مبيعات',
                    'en'        => 'Collection of sales revenue',
                ],
                'in_screen'     => 1,
            ],
            [
                'name'          => [
                    'ar'        => 'صرف نظير مرتجع مبيعات',
                    'en'        => 'Disbursement of sales returns',
                ],
                'in_screen'     => 0,
            ],
            [
                'name'          => [
                    'ar'        => 'صرف سلفة على راتب موظف',
                    'en'        => 'Disbursement of an advance on the salary of an employee',
                ],
                'in_screen'     => 0,
            ],
            [
                'name'          => [
                    'ar'        => 'صرف نظير مشتريات من مورد',
                    'en'        => 'Disbursement for purchases from a supplier',
                ],
                'in_screen'     => 0,
            ],
            [
                'name'          => [
                    'ar'        => 'تحصيل نظير مرتجع مشتربات الى مورد',
                    'en'        => 'Collection of a return counterpart purchased to a supplier',
                ],
                'in_screen'     => 1,
            ],
            [
                'name'          => [
                    'ar'        => 'إيراد زيادة رأس المال',
                    'en'        => 'Capital Increase Revenue',
                ],
                'in_screen'     => 1,
            ],
            [
                'name'          => [
                    'ar'        => 'مصاريف شراء مثل اللولون',
                    'en'        => 'Purchase expenses like Lulon',
                ],
                'in_screen'     => 0,
            ],
            [
                'name'          => [
                    'ar'        => 'استبدال وديعة بنكية',
                    'en'        => 'Exchange for a bank deposit',
                ],
                'in_screen'     => 0,
            ],
            [
                'name'          => [
                    'ar'        => 'استرداد سلفة على راتب الموظف',
                    'en'        => 'refund of an advance on the employee\'s salary',
                ],
                'in_screen'     => 1,
            ],
            [
                'name'          => [
                    'ar'        => 'تحصيل خصومات موظفين',
                    'en'        => 'Collecting employee discounts',
                ],
                'in_screen'     => 1,
            ],
            [
                'name'          => [
                    'ar'        => 'صرف مرتب للموظف',
                    'en'        => 'salary payment to the employee',
                ],
                'in_screen'     => 0,
            ],
            [
                'name'          => [
                    'ar'        => 'اقتراض من بنك',
                    'en'        => 'Borrowing from a bank',
                ],
                'in_screen'     => 1,
            ],
            [
                'name'          => [
                    'ar'        => 'صرف لرد رأس المال',
                    'en'        => 'Disbursement to refund capital',
                ],
                'in_screen'     => 0,
            ],
        ];

        foreach ($types as $type) {
            if (is_null(ShiftType::where('name->en', $type['name']['en'])->where('name->ar', $type['name']['ar'])->first()))
                ShiftType::create($type);
        }
    }
}
