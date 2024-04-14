<?php

namespace App\Http\Api\V1\Requests\Banner;

use App\Http\Api\V1\Requests\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: 'UpdateBannerRequestBody',
    required: true,
    content: [
        new OA\MediaType(
            mediaType: 'application/json',
            schema: new OA\Schema(
                ref: '#/components/schemas/UpdateBannerRequest'
            )
        ),
    ]
)]
#[OA\Schema(
    required: [
        'tag_ids',
        'feature_id',
        'content',
        'is_active',
    ],
    properties: [
        new OA\Property(
            property: 'tag_ids',
            description: 'Идентификаторы тэгов',
            type: 'array',
            items: new OA\Items(
                type: 'integer',
            ),
            example: [1, 2, 3],
            nullable: true,
        ),
        new OA\Property(
            property: 'feature_id',
            description: 'Идентификатор фичи',
            type: 'integer',
            example: 1,
            nullable: true,
        ),
        new OA\Property(
            property: 'content',
            description: 'Содержимое баннера',
            type: 'object',
            example: '{"title": "some_title", "text": "some_text", "url": "some_url"}',
            nullable: true,
            additionalProperties: true,
        ),
        new OA\Property(
            property: 'is_active',
            description: 'Флаг активности баннера',
            type: 'boolean',
            example: true,
            nullable: true,
        )
    ],
)]
class UpdateBannerRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'tag_ids' => ['nullable', 'array', 'exists:tags,id'],
            'feature_id' => ['nullable', 'integer', 'exists:features,id'],
            'content' => ['nullable', 'json'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
