<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponser
{
    public function successResponse(string|array $data, int $code = Response::HTTP_OK) : Response
    {
        return response($data, $code)->header('Content-Type', 'application/json');
    }

    public function validResponse(string|array|object $data, int $code = Response::HTTP_OK) : JsonResponse
    {
        return response()->json(['data' => $data], $code);
    }

    public function errorResponse(string|array|object $message, int $code) : JsonResponse
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }

    public function errorMessage(string $message, int $code) : Response
    {
        return response($message, $code)->header('Content-Type', 'application/json');
    }
}
