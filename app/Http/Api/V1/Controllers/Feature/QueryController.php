<?php

namespace App\Http\Api\V1\Controllers\Feature;

use App\Http\Api\V1\Controllers\Controller;
use App\Http\Api\V1\Requests\PaginationRequest;
use App\Http\DTO\PaginationDto;
use App\Http\Resources\V1\Feature\FeatureCollection;
use App\Http\Resources\V1\Feature\FeatureResource;
use App\Services\V1\Eloquent\Feature\QueryService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class QueryController extends Controller
{
    public function __construct(
        private readonly QueryService $queryService,
    ) {
    }

    #[OA\Get(
        path: '/feature',
        operationId: 'featuresList',
        summary: 'Get list of features',
        security: [['bearerAuth' => []]],
        tags: ['Avito Feature'],
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
            ),
            new OA\Parameter(
                name: 'token',
                description: 'Токен админа',
                in: 'header',
                schema: new OA\Schema(
                    type: 'string',
                    example: 'admin_token'
                )
            ),
        ],
        responses: [
            new OA\Response(
                ref: '#/components/responses/FeatureCollectionResponse',
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
        $features = $this->queryService->getAll($dto->build($request));

        return $this->responseOk(FeatureCollection::make($features));
    }


    #[OA\Get(
        path: '/feature/{id}',
        operationId: 'getFeature',
        summary: 'Get feature by id',
        security: [['bearerAuth' => []]],
        tags: ['Avito Feature'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer'
                )
            ),
            new OA\Parameter(
                name: 'token',
                description: 'Токен админа',
                in: 'header',
                schema: new OA\Schema(
                    type: 'string',
                    example: 'admin_token'
                )
            ),
        ],
        responses: [
            new OA\Response(
                ref: '#/components/responses/FeatureResponse',
                response: 200,
            ),
            new OA\Response(
                ref: '#/components/responses/UnauthorizedResponse',
                response: 401,
            ),
            new OA\Response(
                ref: '#/components/responses/NotFoundResponse',
                response: 404,
            ),
        ]
    )]
    public function show(int $featureId): JsonResponse
    {
        $feature = $this->queryService->getById($featureId);

        return $this->responseOk(FeatureResource::make($feature));
    }
}
