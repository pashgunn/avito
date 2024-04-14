<?php

namespace App\Http\Api\V1\Requests\Banner;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: 'AttachDetachBannerTagsRequestBody',
    required: true,
    content: [
        new OA\MediaType(
            mediaType: 'application/json',
            schema: new OA\Schema(
                ref: '#/components/schemas/AttachDetachBannerTagsRequest'
            )
        ),
    ]
)]
#[OA\Schema(
    required: [
        'tags',
    ],
    properties: [
        new OA\Property(
            property: 'tags',
            type: 'array',
            items: new OA\Items(
                type: 'integer',
                format: 'int64',
            ),
            example: [1, 2, 3],
        ),
    ],
)]
class AttachDetachBannerTagsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'tags' => ['required', 'array'],
            'tags.*' => ['required', 'integer', 'exists:tags,id'],
        ];
    }
}
