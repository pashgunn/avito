<?php

namespace App\Services\V1\Eloquent\Tag;

use App\Http\DTO\Banner\AttachDetachBannerTagsDto;
use App\Http\DTO\Tag\CreateTagDto;
use App\Http\DTO\Tag\UpdateTagDto;
use App\Models\Tag;
use App\Services\V1\Eloquent\Banner\QueryService as BannerQueryService;
use Illuminate\Database\Eloquent\Collection;

readonly class CommandService
{
    public function __construct(
        private QueryService $queryService,
        private BannerQueryService $bannerQueryService,
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

    public function attachTags(int $bannerId, AttachDetachBannerTagsDto $dto): Collection
    {
        $banner = $this->bannerQueryService->getById($bannerId);

        $banner->tags()->sync($dto->tags, false);

        return $banner->tags;
    }

    public function detachTags(int $bannerId, AttachDetachBannerTagsDto $dto): Collection
    {
        $banner = $this->bannerQueryService->getById($bannerId);

        $banner->tags()->detach($dto->tags);

        return $banner->tags;
    }
}