<?php

namespace App\Http\Resources\V1\Support;

use OpenApi\Attributes as OA;

#[OA\Response(
    response: 'NotFoundResponse',
    description: 'Not Found',
    content: new OA\JsonContent(
        ref: '#/components/schemas/NotFound'
    )
)]
#[OA\Schema(
    required: ['error'],
    properties: [
        new OA\Property(
            property: 'error',
            type: 'string',
            example: 'Not Found'
        ),
    ]
)]
class NotFound
{
}
