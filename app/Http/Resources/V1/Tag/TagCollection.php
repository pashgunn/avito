<?php

namespace App\Http\Resources\V1\Tag;

use App\Http\Resources\V1\ResourceCollection;
use OpenApi\Attributes as OA;

#[OA\Response(
    response: 'TagCollectionResponse',
    description: 'Success',
    content: [
        new OA\MediaType(
            mediaType: 'application/json',
            schema: new OA\Schema(
                ref: '#/components/schemas/TagCollection'
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
class TagCollection extends ResourceCollection
{
    public $collects = TagResource::class;
}