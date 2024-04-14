<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

abstract class BaseFilterBuilder
{
    public function __construct(protected Model $model)
    {
    }

    public function apply(array $filters, Builder $query, int $offset, int $limit): Collection
    {
        foreach ($filters as $filterName => $value) {
            $decorator = $this->createFilterDecorator($filterName);

            if ($this->isValidDecorator($decorator)) {
                $query = $decorator::apply($query, $value);
            }
        }

        return $query->offset($offset)->limit($limit)->get();
    }

    protected function createFilterDecorator($name): string
    {
        return __NAMESPACE__ . '\\' . Str::studly($name);
    }

    protected function isValidDecorator($decorator): bool
    {
        return class_exists($decorator);
    }
}
