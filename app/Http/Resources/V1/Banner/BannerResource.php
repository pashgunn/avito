<?php

namespace App\Http\Resources\V1\Banner;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/**
 * @mixin Banner
 */
#[OA\Response(
    response: 'BannerResponse',
    description: 'OK',
    content: [
        new OA\MediaType(
            mediaType: 'application/json',
            schema: new OA\Schema(
                ref: '#/components/schemas/BannerResource'
            )
        ),
    ]
)]
#[OA\Schema(
    required: [
        'banner_id',
        'tag_ids',
        'feature_id',
        'content',
        'created_at',
        'updated_at',
    ],
    properties: [
        new OA\Property(
            property: 'banner_id',
            description: 'Идентификатор баннера',
            type: 'integer',
            example: 1,
        ),
        new OA\Property(
            property: 'tag_ids',
            description: 'Идентификаторы тэгов',
            type: 'array',
            items: new OA\Items(
                type: 'integer',
            ),
            example: [1, 2, 3],
        ),
        new OA\Property(
            property: 'feature_id',
            description: 'Идентификатор фичи',
            type: 'integer',
            example: 1,
        ),
        new OA\Property(
            property: 'content',
            type: 'string',
            example: '{"title": "some_title", "text": "some_text", "url": "some_url"}',
        ),
        new OA\Property(
            property: 'is_active',
            description: 'Флаг активности баннера',
            type: 'boolean',
            example: true,
        ),
        new OA\Property(
            property: 'created_at',
            description: 'Дата создания баннера',
            type: 'string',
            format: 'date-time',
        ),
        new OA\Property(
            property: 'updated_at',
            description: 'Дата обновления баннера',
            type: 'string',
            format: 'date-time',
        ),
    ]
)]
class BannerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'banner_id' => $this->id,
            'tag_ids' => $this->tags()->pluck('tags.id'),
            'feature_id' => $this->feature_id,
            'content' => json_decode($this->content),
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
