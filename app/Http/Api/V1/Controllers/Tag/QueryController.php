<?php

namespace App\Http\Api\V1\Controllers\Tag;

use App\Http\Api\V1\Controllers\Controller;
use App\Http\Api\V1\Requests\PaginationRequest;
use App\Http\DTO\PaginationDto;
use App\Http\Resources\V1\Tag\TagCollection;
use App\Http\Resources\V1\Tag\TagResource;
use App\Services\V1\Eloquent\Tag\QueryService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class QueryController extends Controller
{
    public function __construct(
        private readonly QueryService $queryService,
    ) {
    }

    #[OA\Get(
        path: '/tag',
        operationId: 'tagsList',
        summary: 'Get list of tags',
        security: [['bearerAuth' => []]],
        tags: ['Avito Tag'],
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
                ref: '#/components/responses/TagCollectionResponse',
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
        $tags = $this->queryService->getAll($dto->build($request));

        return $this->responseOk(TagCollection::make($tags));
    }


    #[OA\Get(
        path: '/tag/{id}',
        operationId: 'getTag',
        summary: 'Get tag by id',
        security: [['bearerAuth' => []]],
        tags: ['Avito Tag'],
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
                ref: '#/components/responses/TagResponse',
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
    public function show(int $tagId): JsonResponse
    {
        $tag = $this->queryService->getById($tagId);

        return $this->responseOk(TagResource::make($tag));
    }
}
