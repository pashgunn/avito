<?php

namespace App\Http\Api\V1\Controllers\Banner;

use App\Http\Api\V1\Controllers\Controller;
use App\Http\Api\V1\Requests\Banner\CreateBannerRequest;
use App\Http\Api\V1\Requests\Banner\UpdateBannerRequest;
use App\Http\DTO\Banner\CreateBannerDto;
use App\Http\DTO\Banner\UpdateBannerDto;
use App\Http\Resources\V1\Banner\BannerResource;
use App\Services\V1\Eloquent\Banner\CommandService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class CommandController extends Controller
{
    public function __construct(
        private readonly CommandService $commandService,
    ) {
    }

    #[OA\Post(
        path: '/v1/banners',
        operationId: 'createBanner',
        summary: 'Create banner',
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            ref: '#/components/requestBodies/CreateBannerRequestBody'
        ),
        tags: ['Avito Banner'],
        responses: [
            new OA\Response(
                ref: '#/components/responses/BannerResponse',
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
    public function create(CreateBannerRequest $request, CreateBannerDto $dto): JsonResponse
    {
        $banner = $this->commandService->create($dto->build($request));

        return $this->responseCreated(BannerResource::make($banner));
    }

    #[OA\Put(
        path: '/v1/banners/{id}',
        operationId: 'updateBanner',
        summary: 'Update banner',
        security: [['bearerAuth' => []]],
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
                    type: 'integer',
                ),
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
    public function update(UpdateBannerRequest $request, int $bannerId, UpdateBannerDto $dto): JsonResponse
    {
        $banner = $this->commandService->update($bannerId, $dto->build($request));

        return $this->responseOk(BannerResource::make($banner));
    }

    #[OA\Delete(
        path: '/v1/banners/{id}',
        operationId: 'deleteBanner',
        summary: 'Delete banner',
        security: [['bearerAuth' => []]],
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
    public function delete(int $bannerId): JsonResponse
    {
        $this->commandService->delete($bannerId);

        return $this->responseOkWithMessage('Banner deleted successfully');
    }
}
