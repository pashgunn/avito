<?php

namespace App\Http\DTO\Banner;

use App\Http\DTO\BaseDto;

class CreateBannerDto extends BaseDto
{
    public int $feature_id;

    public string $json_data;
}