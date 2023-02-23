<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;

class JsonHelper
{

    /**
     * @param mixed $data
     * @param int $statusCode
     * @return string
     */
    public static function formatResponse(mixed $data, int $statusCode = 200): string
    {
        return response()->json([
            'status' => $statusCode,
            'data' => $data
        ]);
    }

}
