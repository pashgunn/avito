<?php

namespace App\Http\Api\V1\Controllers\Banner;

use App\Http\Api\V1\Controllers\Controller;
use App\Http\Api\V1\Requests\Banner\FilterBannerRequest;
use App\Http\Api\V1\Requests\Banner\GetBannerRequest;
use App\Http\DTO\Banner\FilterBannerDto;
use App\Http\DTO\Banner\GetBannerDto;
use App\Http\Resources\V1\Banner\BannerCollection;
use App\Http\Resources\V1\Banner\UserBannerResource;
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
        path: '/banner',
        operationId: 'bannersList',
        summary: 'Getting all banners with filtering by feature and/or tag',
        security: [['bearerAuth' => []]],
        tags: ['Avito Banner'],
        parameters: [
            new OA\Parameter(
                name: 'token',
                description: 'Токен админа',
                in: 'header',
                schema: new OA\Schema(
                    type: 'string',
                    example: 'admin_token'
                )
            ),
            new OA\Parameter(
                name: 'feature_id',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    description: 'Идентификатор фичи',
                    type: 'integer',
                )
            ),
            new OA\Parameter(
                name: 'tag_id',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    description: 'Идентификатор тега',
                    type: 'integer',
                )
            ),
            new OA\Parameter(
                name: 'limit',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    description: 'Limit',
                    type: 'integer',
                    default: 10,
                )
            ),
            new OA\Parameter(
                name: 'offset',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    description: 'Offset',
                    type: 'integer',
                )
            ),
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
            new OA\Response(
                ref: '#/components/responses/ForbiddenResponse',
                response: 403,
            ),
            new OA\Response(
                ref: '#/components/responses/InternalServerErrorResponse',
                response: 500,
            ),
        ]
    )]
    public function index(FilterBannerRequest $request, FilterBannerDto $dto): JsonResponse
    {
        $banners = $this->queryService->getAll($dto->buildWithoutNull($request));

        return $this->responseOk(BannerCollection::make($banners));
    }


    #[OA\Get(
        path: '/user_banner',
        operationId: 'getUserBanners',
        summary: 'Получение баннера для пользователя',
        security: [['bearerAuth' => []]],
        tags: ['Avito Banner'],
        parameters: [
            new OA\Parameter(
                name: 'tag_id',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    description: 'Идентификатор тега',
                    type: 'integer',
                )
            ),
            new OA\Parameter(
                name: 'feature_id',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    description: 'Идентификатор фичи',
                    type: 'integer',
                )
            ),
            new OA\Parameter(
                name: 'use_last_revision',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    description: 'Получать актуальную информацию',
                    type: 'boolean',
                    default: false,
                )
            ),
            new OA\Parameter(
                name: 'token',
                description: 'Токен пользователя',
                in: 'header',
                schema: new OA\Schema(
                    type: 'string',
                    example: 'user_token'
                )
            ),
        ],
        responses: [
            new OA\Response(
                ref: '#/components/responses/UserBannerResponse',
                response: 200,
            ),
            new OA\Response(
                ref: '#/components/responses/InvalidDataResponse',
                response: 400,
            ),
            new OA\Response(
                ref: '#/components/responses/UnauthorizedResponse',
                response: 401,
            ),
            new OA\Response(
                ref: '#/components/responses/ForbiddenResponse',
                response: 403,
            ),
            new OA\Response(
                ref: '#/components/responses/NotFoundResponse',
                response: 404,
            ),
        ]
    )]
    public function userBanner(GetBannerRequest $request, GetBannerDto $dto): JsonResponse
    {
        $dto->token = $request->header('token');
        $dto = $dto->build($request);

        $banner = $this->queryService->show($dto);

        return $this->responseOk(UserBannerResource::make($banner));
    }
}
