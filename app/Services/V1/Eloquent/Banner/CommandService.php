<?php

namespace App\Services\V1\Eloquent\Banner;

use App\Http\DTO\Banner\CreateBannerDto;
use App\Http\DTO\Banner\UpdateBannerDto;
use App\Models\Banner;

readonly class CommandService
{
    public function __construct(
        private QueryService $queryService,
    ) {
    }

    public function create(CreateBannerDto $dto): Banner
    {
        $dto->json_data = json_encode($dto->json_data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
        return Banner::create($dto->toArray());
    }

    public function update(int $bannerId, UpdateBannerDto $dto): Banner
    {
        $banner = $this->queryService->getById($bannerId);

        $banner->update($dto->toArray());

        return $banner;
    }

    public function delete(int $bannerId): void
    {
        $banner = $this->queryService->getById($bannerId);

        $banner->delete();
    }
}