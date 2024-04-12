<?php

namespace Database\Factories;

use App\Models\Banner;
use App\Models\Feature;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Banner>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jsonData = json_encode(fake()->text());

        return [
            'feature_id' => Feature::factory(),
            'json_data' => $jsonData,
        ];
    }
}
