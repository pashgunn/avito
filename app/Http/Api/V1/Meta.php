<?php

namespace App\Http\Api\V1;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    description: 'API endpoints for AVITO',
    title: 'AVITO API',
    contact: new OA\Contact(
        email: 'pashaboga4ev@gmail.com'
    )
)]
#[OA\Server(
    url: 'http://0.0.0.0:80/api',
    description: 'Base server for development'
)]
#[OA\Tag(
    name: 'Avito Banner',
    description: 'Avito Banners'
)]
#[OA\Tag(
    name: 'Avito Feature',
    description: 'Avito Features'
)]
#[OA\Tag(
    name: 'Avito Tag',
    description: 'Avito Tags'
)]
class Meta
{
    //It's a fake class
}
