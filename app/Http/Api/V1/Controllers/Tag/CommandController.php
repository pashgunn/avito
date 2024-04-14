<?php

namespace App\Http\Api\V1\Controllers\Tag;

use App\Http\Api\V1\Controllers\Controller;
use App\Http\Api\V1\Requests\Banner\AttachDetachBannerTagsRequest;
use App\Http\Api\V1\Requests\Tag\CreateTagRequest;
use App\Http\Api\V1\Requests\Tag\UpdateTagRequest;
use App\Http\DTO\Banner\AttachDetachBannerTagsDto;
use App\Http\DTO\Tag\CreateTagDto;
use App\Http\DTO\Tag\UpdateTagDto;
use App\Http\Resources\V1\Tag\TagCollection;
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
        path: '/tag',
        operationId: 'createTag',
        summary: 'Create tag',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            ref: '#/components/requestBodies/CreateTagRequestBody'
        ),
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
        ],
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

    #[OA\Post(
        path: '/tag/{banner_id}/attach-tags',
        operationId: 'attachTagsToBanner',
        summary: 'Attach tags to banner',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            ref: '#/components/requestBodies/AttachDetachBannerTagsRequestBody'
        ),
        tags: ['Avito Tag'],
        parameters: [
            new OA\Parameter(
                name: 'banner_id',
                description: 'Banner ID',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer', format: 'int64'),
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
                ref: '#/components/responses/TagCollectionResponse',
                response: 201,
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
    public function attachTags(
        AttachDetachBannerTagsRequest $request,
        int $bannerId,
        AttachDetachBannerTagsDto $dto
    ): JsonResponse {
        $tags = $this->commandService->attachTags($bannerId, $dto->build($request));

        return $this->responseCreated(TagCollection::make($tags));
    }

    #[OA\Put(
        path: '/tag/{id}',
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
        path: '/tag/{id}',
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

    #[OA\Delete(
        path: '/tag/{banner_id}/detach-tags',
        operationId: 'detachTags',
        summary: 'Detach tags from banner',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            ref: '#/components/requestBodies/AttachDetachBannerTagsRequestBody'
        ),
        tags: ['Avito Tag'],
        parameters: [
            new OA\Parameter(
                name: 'banner_id',
                description: 'Banner ID',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer', format: 'int64'),
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
                ref: '#/components/responses/TagCollectionResponse',
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
    public function detachTags(
        AttachDetachBannerTagsRequest $request,
        int $bannerId,
        AttachDetachBannerTagsDto $dto
    ): JsonResponse {
        $tags = $this->commandService->detachTags($bannerId, $dto->build($request));

        return $this->responseOk(TagCollection::make($tags));
    }
}
