<?php

namespace App\Services\V1\Eloquent\Banner;

use App\Http\DTO\PaginationDto;
use App\Models\Banner;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class QueryService
{
    public function getAll(PaginationDto $dto): LengthAwarePaginator
    {
        return Banner::paginate(perPage: $dto->limit, page: $dto->page);
    }

    public function getById(int $id): Banner
    {
        return Banner::findOrFail($id);
    }
}