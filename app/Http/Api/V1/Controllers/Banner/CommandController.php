<?php

namespace App\Http\Api\V1\Controllers\Banner;

use App\Http\Api\V1\Controllers\Controller;
use App\Http\Api\V1\Requests\Banner\BulkDeleteRequest;
use App\Http\Api\V1\Requests\Banner\CreateBannerRequest;
use App\Http\Api\V1\Requests\Banner\UpdateBannerRequest;
use App\Http\Api\V1\Requests\Banner\UpdateStatusBannerRequest;
use App\Http\DTO\Banner\BulkDeleteBannerDto;
use App\Http\DTO\Banner\CreateBannerDto;
use App\Http\DTO\Banner\UpdateBannerDto;
use App\Http\DTO\Banner\UpdateStatusBannerDto;
use App\Http\Resources\V1\Banner\BannerResource;
use App\Http\Resources\V1\Banner\CreateBannerResource;
use App\Services\V1\Eloquent\Banner\CommandService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;

class CommandController extends Controller
{
    public function __construct(
        private readonly CommandService $commandService,
    ) {
    }

    #[OA\Post(
        path: '/banner',
        operationId: 'createBanner',
        summary: 'Создание нового баннера',
        requestBody: new OA\RequestBody(
            ref: '#/components/requestBodies/CreateBannerRequestBody'
        ),
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
        ],
        responses: [
            new OA\Response(
                ref: '#/components/responses/CreateBannerResponse',
                response: 201,
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
                ref: '#/components/responses/InternalServerErrorResponse',
                response: 500,
            ),
        ]
    )]
    public function create(CreateBannerRequest $request, CreateBannerDto $dto): JsonResponse
    {
        $banner = $this->commandService->create($dto->build($request));

        return $this->responseCreated(CreateBannerResource::make($banner));
    }

    #[OA\Put(
        path: '/banner/toggle-status',
        operationId: 'toggleStatus',
        summary: 'Toggle banner status',
        requestBody: new OA\RequestBody(
            ref: '#/components/requestBodies/UpdateStatusBannerRequestBody'
        ),
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
        ],
        responses: [
            new OA\Response(
                ref: '#/components/responses/SuccessResponse',
                response: 200,
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
    public function updateBannerStatus(
        UpdateStatusBannerRequest $request,
        UpdateStatusBannerDto $dto
    ): JsonResponse {
        $isUpdated = $this->commandService->toggleStatus($dto->build($request));

        if (! $isUpdated) {
            return $this->responseBadRequest('Something went wrong');
        }

        return $this->responseOkWithMessage('Banner status updated successfully');
    }

    #[OA\Patch(
        path: '/banner/{id}',
        operationId: 'updateBanner',
        summary: 'Обновление содержимого баннера',
        requestBody: new OA\RequestBody(
            ref: '#/components/requestBodies/UpdateBannerRequestBody'
        ),
        tags: ['Avito Banner'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    description: 'Идентификатор баннера',
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
                ref: '#/components/responses/BannerResponse',
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
            new OA\Response(
                ref: '#/components/responses/InternalServerErrorResponse',
                response: 500,
            ),
        ]
    )]
    public function update(UpdateBannerRequest $request, int $bannerId, UpdateBannerDto $dto): JsonResponse
    {
        $banner = $this->commandService->update($bannerId, $dto->buildWithoutNull($request));

        return $this->responseOk(BannerResource::make($banner));
    }

    #[OA\Delete(
        path: '/banner/{id}',
        operationId: 'deleteBanner',
        summary: 'Удаление баннера по идентификатору',
        tags: ['Avito Banner'],
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
                response: 204,
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
            new OA\Response(
                ref: '#/components/responses/InternalServerErrorResponse',
                response: 500,
            ),
        ]
    )]
    public function delete(int $bannerId): Response
    {
        $this->commandService->delete($bannerId);

        return response()->noContent();
    }

    #[OA\Delete(
        path: '/banner/bulk-delete',
        operationId: 'bulkDeleteBanners',
        summary: 'Bulk delete banners',
        tags: ['Avito Banner'],
        parameters: [
            new OA\Parameter(
                name: 'tag_id',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'integer',
                ),
            ),
            new OA\Parameter(
                name: 'feature_id',
                in: 'query',
                required: false,
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
                ref: '#/components/responses/SuccessResponse',
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
            new OA\Response(
                ref: '#/components/responses/InternalServerErrorResponse',
                response: 500,
            ),
        ]
    )]
    public function deleteBanners(BulkDeleteRequest $request, BulkDeleteBannerDto $dto): JsonResponse
    {
        $this->commandService->deleteBanners($dto->buildWithoutNull($request));

        return $this->responseOkWithMessage('Banners deleted');
    }
}
