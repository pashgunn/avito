<?php

namespace App\Http\Api\V1\Requests;

class OffsetRequest extends BaseRequest
{
    protected array $defaultValues = [
        'offset' => 0,
        'limit' => 10,
    ];

    public function rules(): array
    {
        return [
            'offset' => ['integer', 'min:0'],
            'limit' => ['integer', 'min:1'],
        ];
    }
}
