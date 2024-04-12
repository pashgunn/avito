<?php

namespace App\Http\Resources\V1\Support;

use OpenApi\Attributes as OA;

#[OA\Response(
    response: 'ForbiddenResponse',
    description: 'Forbidden Response',
    content: new OA\JsonContent(
        ref: '#/components/schemas/Forbidden'
    )
)]
#[OA\Schema(
    required: ['message'],
    properties: [
        new OA\Property(
            property: 'message',
            type: 'string',
            example: 'This action is unauthorized.'
        ),
    ],
)]
class Forbidden
{
}
