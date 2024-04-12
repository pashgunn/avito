<?php

namespace App\Http\Api\V1\Requests\Tag;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: 'CreateTagRequestBody',
    required: true,
    content: [
        new OA\MediaType(
            mediaType: 'application/json',
            schema: new OA\Schema(
                ref: '#/components/schemas/CreateTagRequest'
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
            example: 'tag name',
        ),
    ],
)]
class CreateTagRequest extends FormRequest
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
