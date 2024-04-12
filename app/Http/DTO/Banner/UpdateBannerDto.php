<?php

namespace App\Http\DTO\Banner;

use App\Http\DTO\BaseDto;

class UpdateBannerDto extends BaseDto
{
    public ?int $feature_id = null;

    public ?string $json_data = null;
}