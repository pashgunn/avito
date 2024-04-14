<?php

namespace App\Http\Filters\Banner;

use App\Http\Filters\BaseFilter;
use Illuminate\Database\Eloquent\Builder;

class TagId implements BaseFilter
{
    public static function apply(Builder $builder, mixed $value): Builder
    {
        return $builder->whereHas('tags', function ($query) use ($value) {
            $query->where('tag_id', $value);
        });
    }
}