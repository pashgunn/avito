<?php

namespace App\Http\Resources\V1\Feature;

use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/**
 * @mixin Feature
 */
#[OA\Response(
    response: 'FeatureResponse',
    description: 'Success',
    content: [
        new OA\MediaType(
            mediaType: 'application/json',
            schema: new OA\Schema(
                ref: '#/components/schemas/FeatureResource'
            )
        ),
    ]
)]
#[OA\Schema(
    required: [
        'feature_id',
        'name',
        'created_at',
        'updated_at',
    ],
    properties: [
        new OA\Property(
            property: 'feature_id',
            type: 'integer',
            example: 1,
        ),
        new OA\Property(
            property: 'name',
            type: 'string',
            example: 'feature name',
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
class FeatureResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'feature_id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
