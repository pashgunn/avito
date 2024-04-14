<?php

namespace App\Http\DTO\Banner;

use App\Http\DTO\OffsetDto;

class GetBannerDto extends OffsetDto
{
    public int $tag_id;

    public int $feature_id;

    public bool $use_last_revision = false;

    public string $token;
}
