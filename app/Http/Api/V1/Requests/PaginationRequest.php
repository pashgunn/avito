<?php

namespace App\Http\Api\V1\Requests;

class PaginationRequest extends BaseRequest
{
    protected array $defaultValues = [
        'page' => 1,
        'limit' => 10,
    ];

    public function rules(): array
    {
        return [
            'page' => ['integer', 'min:1'],
            'limit' => ['integer', 'min:1'],
        ];
    }
}