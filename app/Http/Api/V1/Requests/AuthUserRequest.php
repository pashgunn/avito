<?php

namespace App\Http\Api\V1\Requests;

use OpenApi\Attributes as OA;

#[OA\RequestBody(
    request: 'AuthUserRequestBody',
    required: true,
    content: [
        new OA\MediaType(
            mediaType: 'application/json',
            schema: new OA\Schema(
                ref: '#/components/schemas/AuthUserRequest'
            )
        ),
    ]
)]
#[OA\Schema(
    required: [
        'email',
        'password',
    ],
    properties: [
        new OA\Property(
            property: 'email',
            description: 'User email',
            type: 'string',
            example: 'admin@test.com',
        ),
        new OA\Property(
            property: 'password',
            description: 'User password',
            type: 'string',
            example: 'password',
        ),
    ],
)]
class AuthUserRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }
}
