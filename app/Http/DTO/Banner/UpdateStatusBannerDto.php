<?php

namespace App\Http\DTO\Banner;

use App\Http\DTO\BaseDto;

class UpdateStatusBannerDto extends BaseDto
{
    public int $banner_id;

    public bool $is_active;
}
