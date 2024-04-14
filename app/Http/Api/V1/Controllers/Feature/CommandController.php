<?php

namespace App\Http\Api\V1\Controllers\Feature;

use App\Http\Api\V1\Controllers\Controller;
use App\Http\Api\V1\Requests\Feature\CreateFeatureRequest;
use App\Http\Api\V1\Requests\Feature\UpdateFeatureRequest;
use App\Http\DTO\Feature\CreateFeatureDto;
use App\Http\DTO\Feature\UpdateFeatureDto;
use App\Http\Resources\V1\Feature\FeatureResource;
use App\Services\V1\Eloquent\Feature\CommandService;
use Illuminate\Http\JsonResponse;
use OpenApi\Attributes as OA;

class CommandController extends Controller
{
    public function __construct(
        private readonly CommandService $commandService,
    ) {
    }

    #[OA\Post(
        path: '/feature',
        operationId: 'createFeature',
        summary: 'Create feature',
        requestBody: new OA\RequestBody(
            ref: '#/components/requestBodies/CreateFeatureRequestBody'
        ),
        tags: ['Avito Feature'],
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
                ref: '#/components/responses/FeatureResponse',
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
    public function create(CreateFeatureRequest $request, CreateFeatureDto $dto): JsonResponse
    {
        $feature = $this->commandService->create($dto->build($request));

        return $this->responseCreated(FeatureResource::make($feature));
    }

    #[OA\Put(
        path: '/feature/{id}',
        operationId: 'updateFeature',
        summary: 'Update feature',
        requestBody: new OA\RequestBody(
            ref: '#/components/requestBodies/UpdateFeatureRequestBody'
        ),
        tags: ['Avito Feature'],
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
            new OA\Response(
                ref: '#/components/responses/InvalidDataResponse',
                response: 422,
            ),
        ]
    )]
    public function update(UpdateFeatureRequest $request, int $featureId, UpdateFeatureDto $dto): JsonResponse
    {
        $feature = $this->commandService->update($featureId, $dto->build($request));

        return $this->responseOk(FeatureResource::make($feature));
    }

    #[OA\Delete(
        path: '/feature/{id}',
        operationId: 'deleteFeature',
        summary: 'Delete feature',
        tags: ['Avito Feature'],
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
    public function delete(int $featureId): JsonResponse
    {
        $this->commandService->delete($featureId);

        return $this->responseOkWithMessage('Feature deleted successfully');
    }
}
