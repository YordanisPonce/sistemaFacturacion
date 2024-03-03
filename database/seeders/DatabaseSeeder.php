<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BillTax;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(
            [
                UserSeeder::class,
                BusinessSeeder::class,
                EnterpriseSeeder::class,
                ClientSeeder::class,
                BillSeeder::class,
                TaxSeeder::class,
            ]
        );
    }
}
