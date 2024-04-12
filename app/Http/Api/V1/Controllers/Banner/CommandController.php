<?php

namespace App\Http\Api\V1\Controllers\Banner;

use App\Http\Api\V1\Controllers\Controller;
use App\Http\Api\V1\Requests\Banner\CreateBannerRequest;
use App\Http\Api\V1\Requests\Banner\UpdateBannerRequest;

class CommandController extends Controller
{
    public function create(CreateBannerRequest $request)
    {
        //
    }

    public function update(UpdateBannerRequest $request, int $bannerId)
    {
        //
    }

    public function delete(int $bannerId)
    {
        //
    }
}
