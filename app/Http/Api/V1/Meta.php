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
    url: 'http://0.0.0.0:8000/api',
    description: 'Base server for development'
)]
#[OA\SecurityScheme(
    securityScheme: 'bearerAuth',
    type: 'http',
    description: '',
    name: 'Authorization',
    in: 'header',
    bearerFormat: '',
    scheme: 'Bearer'
)]
#[OA\Tag(
    name: 'Avito Banner',
    description: 'Avito Banners'
)]
#[OA\Tag(
    name: 'Avito Tag',
    description: 'Avito Tags'
)]
#[OA\Tag(
    name: 'Avito Feature',
    description: 'Avito Features'
)]
class Meta
{
    //It's a fake class
}
