<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\Response as ResponseAlias;

trait BaseApiTrait
{
    protected function successResponse($data, int $status = ResponseAlias::HTTP_OK)
    {
        return response()->json($data, $status);
    }

    protected function errorResponse(string $message, int $status = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR)
    {
        return response()->json(['error' => $message], $status);
    }
}
