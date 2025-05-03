<?php

namespace App\Traits;

trait ApiResponse
{
    protected function success($data, ?string $message = null, $token = null ,int $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
            'token' => $token
        ], $code);
    }

    protected function error(string $message, int $code, $errors = null)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors
        ], $code);
    }
    
    protected function notFound(string $resource = 'Recurso')
    {
        return $this->error("{$resource} não encontrado", 404);
    }
}
