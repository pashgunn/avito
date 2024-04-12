<?php

namespace App\Http\DTO;

class PaginationDto extends BaseDto
{
    public int $page;

    public int $limit;
}