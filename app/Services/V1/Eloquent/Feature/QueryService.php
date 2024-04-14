<?php

namespace App\Services\V1\Eloquent\Feature;

use App\Http\DTO\PaginationDto;
use App\Models\Feature;
use Illuminate\Pagination\LengthAwarePaginator;

class QueryService
{
    public function getAll(PaginationDto $dto): LengthAwarePaginator
    {
        return Feature::paginate(perPage: $dto->limit, page: $dto->page);
    }

    public function getById(int $id): Feature
    {
        return Feature::findOrFail($id);
    }
}
