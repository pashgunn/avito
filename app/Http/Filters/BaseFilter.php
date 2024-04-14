<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

interface BaseFilter
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @return Builder $builder
     */
    public static function apply(Builder $builder, mixed $value): Builder;
}
