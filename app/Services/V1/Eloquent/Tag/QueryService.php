<?php

namespace App\Services\V1\Eloquent\Tag;

use App\Http\DTO\PaginationDto;
use App\Models\Tag;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class QueryService
{
    public function getAll(PaginationDto $dto): LengthAwarePaginator
    {
        return Tag::paginate(perPage: $dto->limit, page: $dto->page);
    }

    public function getById(int $id): Tag
    {
        return Tag::findOrFail($id);
    }
}