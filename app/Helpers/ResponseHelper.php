<?php

namespace App\Helpers;

use Illuminate\Validation\Validator;

class ResponseHelper
{

    public static function getDeleteResponse(int $nmbrOfRowDeleted, string $idToDelete, string $target)
    {
        if ($nmbrOfRowDeleted === 0) {
            $httpCode = HttpCode::DB_ERROR;
            $error = true;
            $data = ['msg' => 'No matching id found, nothing was deleted'];
        } else {
            $httpCode = HttpCode::SUCCESS;
            $error = false;
            $data = ['msg' => $target . ' successfully deleted', 'session_id' => $idToDelete];
        }
        return JsonHelper::formatResponse($data, $httpCode, $error);
    }

    public static function getValidatorFailedResponse(Validator $validator)
    {
        $errorsArray = $validator->errors()->messages();


        return JsonHelper::formatResponse(
            [
                'msg' => 'Error with field(s) : ' . join(', ', array_keys($errorsArray)),
                'fields' => $validator->errors()->all(),
            ],
            HttpCode::VALIDATION_MISSING_PARAMS,
            true
        );
    }

}
