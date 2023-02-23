<?php

namespace App\Http\Controllers;

use App\Helpers\HttpCode;
use App\Helpers\JsonHelper;
use App\Models\Locations;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{

    public function index()
    {
        $locations = Locations::query()
            ->orderBy('name', 'DESC')
            ->get();
        return JsonHelper::formatResponse($locations);
    }

    public function create(Request $request)
    {
        $error = false;
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'address' => 'required',
            ]
        );

        if ($validator->fails()) {
            $errorsArray = $validator->errors()->messages();

            $httpCode = HttpCode::VALIDATION_MISSING_PARAMS;
            $error = true;
            $data = [
                'msg' => 'Missing fields : ' . join(', ', array_keys($errorsArray)),
                'missing_fields' => array_keys($errorsArray),
            ];
        }

        if (!$error) {
            try {
                $data = Locations::query()->create($request->all());
                $httpCode = HttpCode::CREATED;
            } catch (QueryException $exception) {
                $httpCode = HttpCode::DB_ERROR;
                $error = true;
                $data = ['msg' => $exception->getMessage()];
            }
        }
        return JsonHelper::formatResponse($data, $httpCode, $error);
    }

    public function update(Request $request, string $id)
    {
        $error = false;
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'address' => 'required',
            ]
        );

        if ($validator->fails()) {
            $errorsArray = $validator->errors()->messages();
            $httpCode = HttpCode::VALIDATION_MISSING_PARAMS;
            $error = true;
            $data = [
                'msg' => 'Missing fields : ' . join(', ', array_keys($errorsArray)),
                'missing_fields' => array_keys($errorsArray),
            ];
        }

        if (!$error) {
            try {
                $updateData = Locations::query()
                    ->where('id', '=', $id)
                    ->update($request->all());
                if ($updateData === 1) {
                    $data = ['msg' => $updateData . ' row affected'];
                    $httpCode = HttpCode::SUCCESS;
                } else {
                    $httpCode = HttpCode::DB_ERROR;
                    $error = true;
                    $data = ['msg' => 'No rows affected.'];
                }
            } catch (QueryException $exception) {
                $httpCode = HttpCode::DB_ERROR;
                $error = true;
                $data = ['msg' => $exception->getMessage()];
            }
        }
        return JsonHelper::formatResponse($data, $httpCode, $error);
    }

    public function delete(Request $request, string $id)
    {
        $deleteResult = Locations::destroy($id);
        if ($deleteResult === 0) {
            $httpCode = HttpCode::DB_ERROR;
            $error = true;
            $data = ['msg' => 'No matching id found, nothing was deleted'];
        } else {
            $httpCode = HttpCode::SUCCESS;
            $error = false;
            $data = ['msg' => 'Session successfully deleted', 'session_id' => $request->get('id')];
        }

        return JsonHelper::formatResponse($data, $httpCode, $error);
    }


}
