<?php

namespace App\Http\DTO\Banner;

use App\Http\DTO\BaseDto;

class BulkDeleteBannerDto extends BaseDto
{
    public ?int $tag_id = null;

    public ?int $feature_id = null;
}