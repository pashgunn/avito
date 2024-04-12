<?php

namespace App\Http\Api\V1\Controllers\Feature;

use App\Http\Api\V1\Controllers\Controller;
use App\Http\Api\V1\Requests\Feature\CreateFeatureRequest;
use App\Http\Api\V1\Requests\Feature\UpdateFeatureRequest;

class CommandController extends Controller
{
    public function create(CreateFeatureRequest $request)
    {
        //
    }

    public function update(UpdateFeatureRequest $request, int $featureId)
    {
        //
    }

    public function delete(int $featureId)
    {
        //
    }
}
