<?php

namespace App\Http\Resources\V1\Support;

use OpenApi\Attributes as OA;

#[OA\Response(
    response: 'SuccessDeletedResponse',
    description: 'Success Deleted',
)]
class SuccessDeleted
{
}
