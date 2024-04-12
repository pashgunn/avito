<?php

namespace App\Http\Api\V1\Controllers\Tag;

use App\Http\Api\V1\Controllers\Controller;
use App\Http\Api\V1\Requests\Tag\CreateTagRequest;
use App\Http\Api\V1\Requests\Tag\UpdateTagRequest;

class CommandController extends Controller
{
    public function create(CreateTagRequest $request)
    {
        //
    }

    public function update(UpdateTagRequest $request, int $tagId)
    {
        //
    }

    public function destroy(int $tagId)
    {
        //
    }
}
