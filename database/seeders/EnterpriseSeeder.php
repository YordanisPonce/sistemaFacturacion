<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Traits\Business as BusinessTrait;
use App\Models\Enterprise;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class EnterpriseSeeder extends Seeder
{
    use BusinessTrait;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Enterprise::factory(5)->create();
    }
}
