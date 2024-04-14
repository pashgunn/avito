<?php

namespace App\Http\Api\V1\Requests\Banner;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: 'UpdateStatusBannerRequestBody',
    required: true,
    content: [
        new OA\MediaType(
            mediaType: 'application/json',
            schema: new OA\Schema(
                ref: '#/components/schemas/UpdateStatusBannerRequest'
            )
        ),
    ]
)]
#[OA\Schema(
    required: [
        'banner_id',
        'is_active',
    ],
    properties: [
        new OA\Property(
            property: 'banner_id',
            type: 'integer',
            format: 'int64',
            example: 1,
        ),
        new OA\Property(
            property: 'is_active',
            type: 'boolean',
            example: true,
        ),
    ],
)]
class UpdateStatusBannerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'banner_id' => ['required', 'integer', 'exists:banners,id'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}
