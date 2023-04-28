<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            TreasurySeeder::class,
            TreasuryDeliverySeeder::class,

            SectionSeeder::class,
            CategorySeeder::class,
            StoreSeeder::class,
            UnitSeeder::class,
            ItemSeeder::class,

            AccountTypeSeeder::class,
            AccountSeeder::class,
            VendorSeeder::class,
            ShiftSeeder::class,
            ShiftTypeSeeder::class,
            CollectTransactionSeeder::class,
            ExchangeTransactionSeeder::class,


            ItemTransactionCategorySeeder::class,
            ItemTransactionTypeSeeder::class,
            CustomerSeeder::class,
        ]);
    }
}
