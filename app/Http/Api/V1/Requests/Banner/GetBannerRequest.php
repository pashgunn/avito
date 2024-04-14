<?php

namespace App\Http\Api\V1\Requests\Banner;

use App\Http\Api\V1\Requests\BaseRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class GetBannerRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'tag_id' => ['required', 'integer', 'exists:tags,id'],
            'feature_id' => ['required', 'integer', 'exists:features,id'],
            'use_last_revision' => ['boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        parent::prepareForValidation();

        $this->merge([
            'use_last_revision' => filter_var($this->get('use_last_revision'), FILTER_VALIDATE_BOOLEAN),
        ]);
    }
}
