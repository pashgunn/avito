<?php

namespace App\Http\Api\V1\Controllers\Banner;

use App\Http\Api\V1\Controllers\Controller;
use App\Http\Api\V1\Requests\PaginationRequest;
use App\Http\DTO\PaginationDto;
use App\Http\Resources\V1\Banner\BannerCollection;
use App\Http\Resources\V1\Banner\BannerResource;
use App\Services\V1\Eloquent\Banner\QueryService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class QueryController extends Controller
{
    public function __construct(
        private readonly QueryService $queryService,
    ) {
    }

    #[OA\Get(
        path: '/v1/banners',
        operationId: 'bannersList',
        summary: 'Get list of banners',
        security: [['bearerAuth' => []]],
        tags: ['Avito Banner'],
        parameters: [
            new OA\Parameter(
                name: 'limit',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'integer',
                    default: 10
                )
            ),
            new OA\Parameter(
                name: 'page',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'integer',
                    default: 1
                )
            )
        ],
        responses: [
            new OA\Response(
                ref: '#/components/responses/BannerCollectionResponse',
                response: 200,
            ),
            new OA\Response(
                ref: '#/components/responses/UnauthorizedResponse',
                response: 401,
            ),
        ]
    )]
    public function index(PaginationRequest $request, PaginationDto $dto): JsonResponse
    {
        $banners = $this->queryService->getAll($dto->build($request));

        return $this->responseOk(BannerCollection::make($banners));
    }


    #[OA\Get(
        path: '/v1/banners/{id}',
        operationId: 'getBanner',
        summary: 'Get banner by id',
        security: [['bearerAuth' => []]],
        tags: ['Avito Banner'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer'
                )
            ),
        ],
        responses: [
            new OA\Response(
                ref: '#/components/responses/BannerResponse',
                response: 200,
            ),
            new OA\Response(
                ref: '#/components/responses/UnauthorizedResponse',
                response: 401,
            ),
        ]
    )]
    public function show(int $bannerId): JsonResponse
    {
        $banner = $this->queryService->getById($bannerId);

        return $this->responseOk(BannerResource::make($banner));
    }
}
