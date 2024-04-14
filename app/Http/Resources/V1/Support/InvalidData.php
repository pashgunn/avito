<?php

namespace App\Http\Resources\V1\Support;

use OpenApi\Attributes as OA;

#[OA\Response(
    response: 'InvalidDataResponse',
    description: 'Некорректные данные',
    content: new OA\JsonContent(
        ref: '#/components/schemas/InvalidData'
    )
)]
#[OA\Schema(
    required: [
        'error',
    ],
    properties: [
        new OA\Property(
            property: 'error',
            type: 'string',
            example: 'Any error message'
        ),
    ],
)]
class InvalidData
{
}
