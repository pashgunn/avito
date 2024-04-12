<?php

namespace App\Http\Resources\V1;

use OpenApi\Attributes as OA;

#[OA\Schema(
    required: ['data'],
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                type: 'object'
            )
        ),
        new OA\Property(
            property: 'meta',
            properties: [
                new OA\Property(
                    property: 'current_page',
                    type: 'number',
                    example: 2
                ),
                new OA\Property(
                    property: 'from',
                    type: 'number',
                    example: 1
                ),
                new OA\Property(
                    property: 'last_page',
                    type: 'number',
                    example: 8
                ),
                new OA\Property(
                    property: 'links',
                    type: 'object'
                ),
                new OA\Property(
                    property: 'path',
                    type: 'string',
                    example: 'http://0.0.0.0/api/v1/object/list?page=2',
                ),
                new OA\Property(
                    property: 'per_page',
                    type: 'number',
                    example: 1,
                ),
                new OA\Property(
                    property: 'to',
                    type: 'number',
                    example: 1,
                ),
                new OA\Property(
                    property: 'total',
                    type: 'number',
                    example: 1,
                ),
            ],
            type: 'object'
        ),
    ]
)]
class ResourceCollection extends \Illuminate\Http\Resources\Json\ResourceCollection
{
    public function toArray($request): array
    {
        $resource = $this->resource->toArray();

        return [
            'data' => $this->collection,
            'meta' => [
                'current_page' => $resource['current_page'],
                'from' => $resource['from'],
                'last_page' => $resource['last_page'],
                'path' => $resource['path'],
                'per_page' => $resource['per_page'],
                'to' => $resource['to'],
                'total' => $resource['total']
            ]
        ];
    }
}
