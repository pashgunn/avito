<?php

namespace App\Http\Api\V1\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller
{
    private function jsonResponse(JsonResource|array $data, int $statusCode): JsonResponse
    {
        return response()->json($data, $statusCode);
    }

    protected function responseCreated(JsonResource $data): JsonResponse
    {
        return $this->jsonResponse($data, Response::HTTP_CREATED);
    }

    protected function responseOk(JsonResource|array|null $data = null): JsonResponse
    {
        return $this->jsonResponse($data, Response::HTTP_OK);
    }

    protected function responseOkWithMessage(string $message): JsonResponse
    {
        return $this->jsonResponse(['message' => $message], Response::HTTP_OK);
    }

    protected function responseBadRequest(string $message): JsonResponse
    {
        return $this->jsonResponse(['message' => $message], Response::HTTP_BAD_REQUEST);
    }
}
