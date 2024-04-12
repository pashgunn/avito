<?php

namespace App\Http\Resources\V1\Support;

use OpenApi\Attributes as OA;

#[OA\Response(
    response: 'SuccessDeletedResponse',
    description: 'Success Deleted',
    content: new OA\JsonContent(
        ref: '#/components/schemas/SuccessDeleted'
    )
)]
#[OA\Schema(
    required: ['message'],
    properties: [
        new OA\Property(
            property: 'message',
            type: 'string',
            example: 'Success deleted.'
        ),
    ],
)]
class SuccessDeleted
{
}
