<?php

namespace Database\Factories;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Seller>
 */
class SellerFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            "name" => $this->faker->name(),
            "token" => $this->faker->uuid(),
            "created_at" => $this->faker->dateTimeBetween('2022-09-01', '2022-09-05'),
            "updated_at" => $this->faker->dateTimeBetween('2022-09-06', '2022-09-10'),
        ];
    }
}
