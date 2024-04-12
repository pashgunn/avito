<?php

namespace App\Http\Resources\V1\Support;

use OpenApi\Attributes as OA;

#[OA\Response(
    response: 'InvalidDataResponse',
    description: 'Invalid data',
    content: new OA\JsonContent(
        ref: '#/components/schemas/InvalidData'
    )
)]
#[OA\Schema(
    required: [
        'message',
        'errors',
    ],
    properties: [
        new OA\Property(
            property: 'message',
            type: 'string',
            example: 'Any error message'
        ),

        new OA\Property(
            property: 'errors',
            type: 'object',
            additionalProperties: new OA\AdditionalProperties(
                type: 'array',
                items: new OA\Items(
                    type: 'string',
                    example: 'Validation error'
                ),
            ),
        )
    ],
)]
class InvalidData
{
}
