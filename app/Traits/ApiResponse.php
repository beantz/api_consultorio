<?php

namespace App\Traits;

trait ApiResponse
{
    protected function success($data, ?string $message = null, int $code)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
            'status' => $code
        ], $code);
    }

    protected function error(string $message, int $code)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'status' => $code 
        ], $code);
    }
    
    // protected function notFound(string $resource = 'Recurso')
    // {
    //     return $this->error("{$resource} não encontrado", 404);
    // }
}
