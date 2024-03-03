<?php

namespace Database\Factories;

use App\Models\Business;
use App\Models\Enterprise;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $business = fake()->unique()->randomElement(Business::all());
        return ['enterprise_id' => Enterprise::inRandomOrder()->first()->id, 'business_id' => $business ? $business->id : null];
    }
}
