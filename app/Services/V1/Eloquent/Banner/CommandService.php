<?php

namespace App\Services\V1\Eloquent\Banner;

use App\Http\DTO\Banner\BulkDeleteBannerDto;
use App\Http\DTO\Banner\CreateBannerDto;
use App\Http\DTO\Banner\UpdateBannerDto;
use App\Http\DTO\Banner\UpdateStatusBannerDto;
use App\Jobs\DeleteBanner;
use App\Models\Banner;

readonly class CommandService
{
    public function __construct(
        private QueryService $queryService,
    ) {
    }

    public function create(CreateBannerDto $dto): Banner
    {
        $tags = $dto->tag_ids;
        unset($dto->tag_ids);

        $dto->content = json_encode(
            $dto->content,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK
        );

        $banner =  Banner::create($dto->toArrayWithoutNull());

        $banner->tags()->sync($tags);

        return $banner;
    }

    public function update(int $bannerId, UpdateBannerDto $dto): Banner
    {
        $banner = $this->queryService->getById($bannerId);

        $banner->update($dto->toArrayWithoutNull());

        return $banner;
    }

    public function delete(int $bannerId): void
    {
        $banner = $this->queryService->getById($bannerId);

        $banner->delete();
    }

    public function toggleStatus(UpdateStatusBannerDto $dto): bool|int
    {
        return Banner::query()->where('id', $dto->banner_id)->update(['is_active' => $dto->is_active]);
    }

    public function deleteBanners(BulkDeleteBannerDto $dto): void
    {
        DeleteBanner::dispatch($dto->tag_id, $dto->feature_id);
    }
}