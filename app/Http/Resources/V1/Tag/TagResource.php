<?php

namespace App\Http\Resources\V1\Tag;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/**
 * @mixin Tag
 */
#[OA\Response(
    response: 'TagResponse',
    description: 'Success',
    content: [
        new OA\MediaType(
            mediaType: 'application/json',
            schema: new OA\Schema(
                ref: '#/components/schemas/TagResource'
            )
        ),
    ]
)]
#[OA\Schema(
    required: [
        'id',
        'name',
        'created_at',
        'updated_at',
    ],
    properties: [
        new OA\Property(
            property: 'id',
            type: 'integer',
            example: 1,
        ),
        new OA\Property(
            property: 'name',
            type: 'string',
            example: 'tag name',
        ),
        new OA\Property(
            property: 'created_at',
            type: 'string',
            format: 'date-time',
        ),
        new OA\Property(
            property: 'updated_at',
            type: 'string',
            format: 'date-time',
        ),
    ]
)]
class TagResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
