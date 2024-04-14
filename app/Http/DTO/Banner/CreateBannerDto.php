<?php

namespace App\Http\DTO\Banner;

use App\Http\DTO\BaseDto;

class CreateBannerDto extends BaseDto
{
    public array $tag_ids;

    public int $feature_id;

    public string $content;

    public bool $is_active;
}
