<?php

namespace App\Http\Resources\V1\Feature;

use App\Http\Resources\V1\ResourceCollection;
use OpenApi\Attributes as OA;

#[OA\Response(
    response: 'FeatureCollectionResponse',
    description: 'Success',
    content: [
        new OA\MediaType(
            mediaType: 'application/json',
            schema: new OA\Schema(
                ref: '#/components/schemas/FeatureCollection'
            )
        ),
    ]
)]
#[OA\Schema(
    required: ['data'],
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/FeatureResource'
            )
        ),
    ]
)]
class FeatureCollection extends ResourceCollection
{
    public $collects = FeatureResource::class;
}