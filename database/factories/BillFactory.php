<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Enterprise;
use App\Services\BillService;
use App\Services\EnterpriseService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $client = Client::inRandomOrder()->first();
        $billService = new BillService(null, null, null);
        return [
            'correlative_number' => $billService->getCorrelativeNumber($client->enterprise),
            'client_id' => $client->id,
            'amount' => random_int(1, 100),
            'item' => fake()->text(),
            'unit_cost' => 45
        ];
    }
}
