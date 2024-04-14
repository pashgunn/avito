<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Models\BannerTag;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class BannerTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = Banner::pluck('id');
        $tags = Tag::pluck('id');

        foreach ($banners as $banner) {
            BannerTag::factory()->create([
                'banner_id' => $banner,
                'tag_id' => $tags->random(),
            ]);
        }
    }
}
