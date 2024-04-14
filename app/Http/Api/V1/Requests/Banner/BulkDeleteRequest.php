<?php

namespace App\Http\Api\V1\Requests\Banner;

use App\Http\Api\V1\Requests\BaseRequest;

class BulkDeleteRequest extends BaseRequest
{

    public function rules(): array
    {
        return [
            'tag_id' => ['required_without:feature_id', 'integer', 'exists:tags,id'],
            'feature_id' => ['required_without:tag_id', 'integer', 'exists:features,id'],
        ];
    }
}