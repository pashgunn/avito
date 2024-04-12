<?php

namespace App\Http\Resources\V1\Banner;

use Illuminate\Http\Resources\Json\ResourceCollection;
use OpenApi\Attributes as OA;

#[OA\Response(
    response: 'BannerCollectionResponse',
    description: 'Success',
    content: [
        new OA\MediaType(
            mediaType: 'application/json',
            schema: new OA\Schema(
                ref: '#/components/schemas/BannerCollection'
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
                ref: '#/components/schemas/BannerResource'
            )
        ),
    ]
)]
class BannerCollection extends ResourceCollection
{
    public $collects = BannerResource::class;
}