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
    response: 'CreateBannerResponse',
    description: 'Created',
    content: [
        new OA\MediaType(
            mediaType: 'application/json',
            schema: new OA\Schema(
                ref: '#/components/schemas/CreateBannerResource'
            )
        ),
    ]
)]
#[OA\Schema(
    required: [
        'banner_id',
    ],
    properties: [
        new OA\Property(
            property: 'banner_id',
            description: 'Идентификатор созданного баннера',
            type: 'integer',
            example: 1,
        ),
    ]
)]
class CreateBannerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'banner_id' => $this->id,
        ];
    }
}
