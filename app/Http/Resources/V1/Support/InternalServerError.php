<?php

namespace App\Http\Resources\V1\Support;

use OpenApi\Attributes as OA;

#[OA\Response(
    response: 'InternalServerErrorResponse',
    description: 'Internal server error',
    content: new OA\JsonContent(
        ref: '#/components/schemas/InternalServerError'
    )
)]
#[OA\Schema(
    required: ['message'],
    properties: [
        new OA\Property(
            property: 'error',
            type: 'string',
        ),
    ],
    type: 'object',
)]
class InternalServerError
{
}
