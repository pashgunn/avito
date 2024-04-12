<?php

namespace App\Services\V1\Eloquent\Feature;

use App\Http\DTO\Feature\CreateFeatureDto;
use App\Http\DTO\Feature\UpdateFeatureDto;
use App\Models\Feature;

readonly class CommandService
{
    public function __construct(
        private QueryService $queryService,
    ) {
    }

    public function create(CreateFeatureDto $dto): Feature
    {
        return Feature::create($dto->toArray());
    }

    public function update(int $featureId, UpdateFeatureDto $dto): Feature
    {
        $feature = $this->queryService->getById($featureId);

        $feature->update($dto->toArray());

        return $feature;
    }

    public function delete(int $featureId): void
    {
        $feature = $this->queryService->getById($featureId);

        $feature->delete();
    }
}