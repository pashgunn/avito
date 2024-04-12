<?php

namespace App\Http\Api\V1\Requests\Tag;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: 'UpdateTagRequestBody',
    required: true,
    content: [
        new OA\MediaType(
            mediaType: 'application/json',
            schema: new OA\Schema(
                ref: '#/components/schemas/UpdateTagRequest'
            )
        ),
    ]
)]
#[OA\Schema(
    properties: [
        new OA\Property(
            property: 'name',
            type: 'string',
            example: 'tag name',
        ),
    ],
)]
class UpdateTagRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
        ];
    }
}
