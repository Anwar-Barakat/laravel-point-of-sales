<?php

namespace Database\Seeders;

use App\Models\ItemTransactionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemTransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types   = [
            [
                'id'            => 1,
                'name'          => [
                    'en'        => 'purchases',
                    'ar'        => "مشتريات",
                ],
            ],
            [
                'id'            => 2,
                'name'          => [
                    'en'        => 'Returned purchases with the original invoice',
                    'ar'        => 'مرتجع مشتريات بأصل الفاتورة',
                ],
            ],
            [
                'id'            => 3,
                'name'          => [
                    'en'        => 'General Purchase Returns',
                    'ar'        => 'مرتجع مشتريات عام',
                ],
            ],
            [
                'id'            => 4,
                'name'          => [
                    'en'        => 'Sales',
                    'ar'        => 'مبيعات',
                ],
            ],
            [
                'id'            => 5,
                'name'          => [
                    'en'        => 'General Sales Returns',
                    'ar'        => 'مرتجع مبيعات',
                ],
            ],
            [
                'id'            => 6,
                'name'          => [
                    'en'        => 'Internal exchange for a representative',
                    'ar'        => 'صرف داخلي لمندوب',
                ],
            ],
            [
                'id'            => 7,
                'name'          => [
                    'en'        => 'Internal exchange return for a representative',
                    'ar'        => 'مرتجع صرف داخلي لمندوب',
                ],
            ],
            [
                'id'            => 8,
                'name'          => [
                    'en'        => 'Transfer between stores',
                    'ar'        => 'تحويل بين المخازن',
                ],
            ],
            [
                'id'            => 9,
                'name'          => [
                    'en'        => 'Direct exchange sales',
                    'ar'        => 'مبيعات صرف مباشر لعميل',
                ],
            ],
            [
                'id'            => 10,
                'name'          => [
                    'en'        => 'Exchange sales for delivery representative',
                    'ar'        => 'مبيعات صرف لمندوب التوصيل',
                ],
            ],
            [
                'id'            => 11,
                'name'          => [
                    'en'        => 'Disbursement of raw materials for the manufacturing line',
                    'ar'        => 'صرف خامات لخط التصنيع',
                ],
            ],
            [
                'id'            => 12,
                'name'          => [
                    'en'        => 'Disbursement of raw materials from the manufacturing line',
                    'ar'        => 'صرف خامات من خط التصنيع',
                ],
            ],
            [
                'id'            => 13,
                'name'          => [
                    'en'        => 'Receiving complete production from the manufacturing line',
                    'ar'        => 'استلام انتاج تام من خط التصنيع',
                ],
            ],
            [
                'id'            => 14,
                'name'          => [
                    'en'        => 'Complete production of manufacturing line',
                    'ar'        => 'رد انتاج تام من خط التصنيع',
                ],
            ],
        ];

        foreach ($types as $type) {
            if (is_null(ItemTransactionType::where('name->en', $type['name']['en'])->where('name->ar', $type['name']['ar'])->first()))
                ItemTransactionType::create($type);
        }
    }
}
