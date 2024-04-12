<?php

namespace App\Http\Api\V1\Requests\Banner;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
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
        'feature_id',
        'json_data',
    ],
    properties: [
        new OA\Property(
            property: 'feature_id',
            type: 'integer',
            example: 1,
        ),
        new OA\Property(
            property: 'json_data',
            type: 'string',
            example: "{\"url\": \"https://google.com\", \"title\": \"google\"}",
        ),
    ],
)]
class CreateBannerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'feature_id' => ['required', 'integer', 'exists:features,id'],
            'json_data' => ['required', 'json'],
        ];
    }
}
