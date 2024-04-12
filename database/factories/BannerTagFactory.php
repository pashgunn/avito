<?php

namespace Database\Factories;

use App\Models\Banner;
use App\Models\BannerTag;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BannerTag>
 */
class BannerTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'banner_id' => Banner::factory(),
            'tag_id' => Tag::factory(),
        ];
    }
}
