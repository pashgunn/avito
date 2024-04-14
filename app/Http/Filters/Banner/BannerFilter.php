<?php

namespace App\Http\Filters\Banner;

use App\Http\Filters\BaseFilterBuilder;
use App\Models\Banner;
use Illuminate\Support\Str;

class BannerFilter extends BaseFilterBuilder
{
    public function __construct(Banner $banner)
    {
        parent::__construct($banner);
    }

    protected function createFilterDecorator($name): string
    {
        return __NAMESPACE__ . '\\' . Str::studly($name);
    }
}

