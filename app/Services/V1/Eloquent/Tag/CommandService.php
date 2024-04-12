<?php

namespace App\Services\V1\Eloquent\Tag;

use App\Http\DTO\Tag\CreateTagDto;
use App\Http\DTO\Tag\UpdateTagDto;
use App\Models\Tag;

readonly class CommandService
{
    public function __construct(
        private QueryService $queryService,
    ) {
    }

    public function create(CreateTagDto $dto): Tag
    {
        return Tag::create($dto->toArray());
    }

    public function update(int $tagId, UpdateTagDto $dto): Tag
    {
        $tag = $this->queryService->getById($tagId);

        $tag->update($dto->toArray());

        return $tag;
    }

    public function delete(int $tagId): void
    {
        $tag = $this->queryService->getById($tagId);

        $tag->delete();
    }
}