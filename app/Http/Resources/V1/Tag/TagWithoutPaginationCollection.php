<?php

namespace App\Http\Resources\V1\Tag;

use Illuminate\Http\Resources\Json\ResourceCollection;
use OpenApi\Attributes as OA;

#[OA\Response(
    response: 'TagWithoutPaginationCollectionResponse',
    description: 'Success',
    content: [
        new OA\MediaType(
            mediaType: 'application/json',
            schema: new OA\Schema(
                ref: '#/components/schemas/TagWithoutPaginationCollection'
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
                ref: '#/components/schemas/TagResource'
            )
        ),
    ]
)]
class TagWithoutPaginationCollection extends ResourceCollection
{
    public $collects = TagResource::class;
}
