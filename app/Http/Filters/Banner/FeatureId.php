<?php

namespace App\Http\Filters\Banner;

use App\Http\Filters\BaseFilter;
use Illuminate\Database\Eloquent\Builder;

class FeatureId implements BaseFilter
{

    public static function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->where('feature_id', $value);
    }
}