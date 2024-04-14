<?php

namespace App\Http\Api\V1\Requests\Banner;

use App\Http\Api\V1\Requests\OffsetRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class FilterBannerRequest extends OffsetRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $paginationParameters = parent::rules();

        $bannerParameters = [
            'feature_id' => ['integer', 'exists:features,id'],
            'tag_id' => ['integer', 'exists:tags,id'],
        ];

        return array_merge($paginationParameters, $bannerParameters);
    }
}
