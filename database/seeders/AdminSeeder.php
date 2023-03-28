<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins =  [
            [
                'name'              => fake()->name(),
                'email'             => 'admin@admin.com',
                'password'          => Hash::make('adminadmin'),
                'company_code'      => 1
            ],
        ];

        foreach ($admins as $admin) {
            if (is_null(Admin::where(['email' => $admin['email']])->first()))
                Admin::create($admin);
        }
    }
}
