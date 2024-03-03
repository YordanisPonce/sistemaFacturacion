<?php

namespace Database\Factories;

use App\Models\Business;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enterprise>
 */
class EnterpriseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $business = fake()->unique()->randomElement(Business::all());
        return [
            'business_id' => $business->id,
            'slug' => Str::slug($business->name),
            'coin' => 'USD',
            'description' => fake()->text(),
            'user_id' => User::inRandomOrder()->first()->id
        ];
    }
}
