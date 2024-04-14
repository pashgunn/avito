<?php

namespace App\Services\V1\Eloquent\Banner;

use App\Exceptions\BannerNotFoundException;
use App\Http\DTO\Banner\FilterBannerDto;
use App\Http\DTO\Banner\GetBannerDto;
use App\Http\Filters\Banner\BannerFilter;
use App\Models\Banner;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Finder\Exception\AccessDeniedException;

readonly class QueryService
{
    private const CACHE_DURATION = 5;

    private Carbon $cacheDuration;

    public function __construct(
        private BannerFilter $bannerFilter,
    ) {
        $this->cacheDuration = now()->addMinutes(self::CACHE_DURATION);
    }

    public function getAll(FilterBannerDto $dto): Collection
    {
        $bannerQuery = Banner::query()->with('tags')->orderBy('banners.id');

        $cacheKey = 'banners:'.$dto->offset.':'.$dto->limit;

        $banners = $this->bannerFilter->apply(
            $dto->toArrayWithoutNull(),
            $bannerQuery,
            $dto->offset,
            $dto->limit,
        );

        return Cache::remember($cacheKey, $this->cacheDuration, fn () => $banners);
    }

    public function getById(int $id): Banner
    {
        $banner = Banner::query()->with('tags')->find($id);

        if (! $banner) {
            throw new BannerNotFoundException();
        }

        return $banner;
    }

    public function show(GetBannerDto $dto): ?Banner
    {
        $banner = Banner::where('banners.feature_id', $dto->feature_id)->whereHas(
            'tags',
            fn ($query) => $query->where('banner_tags.tag_id', $dto->tag_id)
        )->first();

        if (! $banner) {
            throw new BannerNotFoundException();
        }

        if ($dto->token === config('app.user_token') && ! $banner->is_active) {
            throw new AccessDeniedException('Banner is not active');
        }

        if ($dto->use_last_revision) {
            return $banner;
        }

        return Cache::remember(
            'banner:feature:'.$dto->feature_id.':tag:'.$dto->tag_id,
            $this->cacheDuration,
            fn () => $banner
        );
    }
}
