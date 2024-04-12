<?php

namespace App\Http\Api\V1\Requests\Feature;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: 'CreateFeatureRequestBody',
    required: true,
    content: [
        new OA\MediaType(
            mediaType: 'application/json',
            schema: new OA\Schema(
                ref: '#/components/schemas/CreateFeatureRequest'
            )
        ),
    ]
)]
#[OA\Schema(
    required: ['name'],
    properties: [
        new OA\Property(
            property: 'name',
            type: 'string',
            example: 'feature name',
        ),
    ],
)]
class CreateFeatureRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
        ];
    }
}
