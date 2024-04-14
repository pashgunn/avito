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
    response: 'UserBannerResponse',
    description: 'OK',
    content: [
        new OA\MediaType(
            mediaType: 'application/json',
            schema: new OA\Schema(
                ref: '#/components/schemas/UserBannerResource'
            )
        ),
    ]
)]
#[OA\Schema(
    required: [
        'content',
    ],
    properties: [
        new OA\Property(
            property: 'content',
            type: 'string',
            example: '{"title": "some_title", "text": "some_text", "url": "some_url"}',
        ),
    ]
)]
class UserBannerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'content' => json_decode($this->content),
        ];
    }
}
