<?php

namespace App\Http\Api\V1\Requests\Banner;

use App\Http\Api\V1\Requests\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;
use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: 'CreateBannerRequestBody',
    required: true,
    content: [
        new OA\MediaType(
            mediaType: 'application/json',
            schema: new OA\Schema(
                ref: '#/components/schemas/CreateBannerRequest'
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
        ),
        new OA\Property(
            property: 'feature_id',
            description: 'Идентификатор фичи',
            type: 'integer',
            example: 1,
        ),
        new OA\Property(
            property: 'content',
            description: 'Содержимое баннера',
            type: 'object',
            example: '{"title": "some_title", "text": "some_text", "url": "some_url"}',
            additionalProperties: true,
        ),
        new OA\Property(
            property: 'is_active',
            description: 'Флаг активности баннера',
            type: 'boolean',
            example: true,
        )
    ],
)]
class CreateBannerRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'tag_ids' => ['required', 'array'],
            'tag_ids.*' => ['integer', 'exists:tags,id'],
            'feature_id' => ['required', 'integer', 'exists:features,id'],
            'content' => ['required', 'json'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
