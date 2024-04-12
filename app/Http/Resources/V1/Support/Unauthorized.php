<?php

namespace App\Http\Resources\V1\Support;

use OpenApi\Attributes as OA;

#[OA\Response(
    response: 'UnauthorizedResponse',
    description: 'Unauthorized',
    content: new OA\JsonContent(
        ref: '#/components/schemas/Unauthorized'
    )
)]
#[OA\Schema(
    required: ['message'],
    properties: [
        new OA\Property(
            property: 'message',
            type: 'string',
            example: 'Unauthorized'
        ),
    ],
)]
class Unauthorized
{
}
