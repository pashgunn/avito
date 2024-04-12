<?php

namespace App\Http\DTO\Tag;

use App\Http\DTO\BaseDto;

class UpdateTagDto extends BaseDto
{
    public ?string $name = null;
}