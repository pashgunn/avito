<?php

namespace App\Http\DTO\Banner;

use App\Http\DTO\OffsetDto;

class FilterBannerDto extends OffsetDto
{
    public int $feature_id;

    public int $tag_id;
}
