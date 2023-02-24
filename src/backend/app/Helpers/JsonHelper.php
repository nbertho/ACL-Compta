<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;

class JsonHelper
{

    /**
     * @param mixed $data
     * @param int $statusCode
     * @param bool $error
     * @return string
     * @throws \Exception
     */
    public static function formatResponse(mixed $data, int $statusCode = HttpCode::SUCCESS, bool $error = false): string
    {

        /**
         * @todo Next if statement is only for dev. consistency check and should be removed before build
         */
        if ($error) {
            if ($statusCode === HttpCode::SUCCESS) {
                throw new \Exception("Success status code found (200) but error was set to true in JsonHelper");
            }
            if (!array_key_exists('msg', $data)) {
                throw new \Exception("'msg' key not found in data array");
            }
        }
        return json_encode([
            'status' => $statusCode,
            'error' => $error,
            'data' => $data
        ]);
    }

}
