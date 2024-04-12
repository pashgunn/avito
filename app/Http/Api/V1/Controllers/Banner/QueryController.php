<?php

namespace App\Http\Api\V1\Controllers\Banner;

use App\Http\Api\V1\Controllers\Controller;
use App\Services\V1\Eloquent\Banner\QueryService;
use OpenApi\Attributes as OA;

class QueryController extends Controller
{
    public function __construct(
        private readonly QueryService $queryService,
    )
    {
    }

    #[OA\Get(
        path: '/v1/banners',
        operationId: 'bannersList',
        summary: 'Get list of banners',
        security: [['bearerAuth' => []]],
        tags: ['Avito Banner'],
        responses: [
            new OA\Response(
                ref: '#/components/responses/BannerResponse',
                response: 200,
            ),
            new OA\Response(
                ref: '#/components/responses/BadOperationResponse',
                response: 400
            ),
            new OA\Response(
                ref: '#/components/responses/UnauthorizedResponse',
                response: 401,
            ),
        ]
    )]
    public function index()
    {
        return $this->queryService->getAll();
    }


    public function show(int $bannerId)
    {
        //
    }
}
