<?php

namespace App\Http\Api\V1\Controllers\Tag;

use App\Http\Api\V1\Controllers\Controller;
use App\Http\Api\V1\Requests\Tag\CreateTagRequest;
use App\Http\Api\V1\Requests\Tag\UpdateTagRequest;
use App\Http\DTO\Tag\CreateTagDto;
use App\Http\DTO\Tag\UpdateTagDto;
use App\Http\Resources\V1\Tag\TagResource;
use App\Services\V1\Eloquent\Tag\CommandService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class CommandController extends Controller
{
    public function __construct(
        private readonly CommandService $commandService,
    ) {
    }

    #[OA\Post(
        path: '/v1/tags',
        operationId: 'createTag',
        summary: 'Create tag',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            ref: '#/components/requestBodies/CreateTagRequestBody'
        ),
        tags: ['Avito Tag'],
        responses: [
            new OA\Response(
                ref: '#/components/responses/TagResponse',
                response: 201,
            ),
            new OA\Response(
                ref: '#/components/responses/UnauthorizedResponse',
                response: 401,
            ),
            new OA\Response(
                ref: '#/components/responses/InvalidDataResponse',
                response: 422,
            ),
        ]
    )]
    public function create(CreateTagRequest $request, CreateTagDto $dto): JsonResponse
    {
        $tag = $this->commandService->create($dto->build($request));

        return $this->responseCreated(TagResource::make($tag));
    }

    #[OA\Put(
        path: '/v1/tags/{id}',
        operationId: 'updateTag',
        summary: 'Update tag',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            ref: '#/components/requestBodies/UpdateTagRequestBody'
        ),
        tags: ['Avito Tag'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                ),
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
            new OA\Response(
                ref: '#/components/responses/InvalidDataResponse',
                response: 422,
            ),
        ]
    )]
    public function update(UpdateTagRequest $request, int $tagId, UpdateTagDto $dto): JsonResponse
    {
        $tag = $this->commandService->update($tagId, $dto->build($request));

        return $this->responseOk(TagResource::make($tag));
    }

    #[OA\Delete(
        path: '/v1/tags/{id}',
        operationId: 'deleteTag',
        summary: 'Delete tag',
        security: [['bearerAuth' => []]],
        tags: ['Avito Tag'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                ref: '#/components/responses/SuccessDeletedResponse',
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
    public function delete(int $tagId): JsonResponse
    {
        $this->commandService->delete($tagId);

        return $this->responseOkWithMessage('Tag deleted successfully');
    }
}
