<?php

namespace App\Http\Controllers;

use App\Helpers\HttpCode;
use App\Helpers\JsonHelper;
use App\Helpers\ResponseHelper;
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
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'address' => 'required',
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::getValidatorFailedResponse($validator);
        }

        try {
            $data = Locations::query()->create($request->all());
            $httpCode = HttpCode::CREATED;
        } catch (QueryException $exception) {
            return JsonHelper::formatResponse(
                ['msg' => $exception->getMessage()],
                HttpCode::DB_ERROR,
                true
            );
        }
        return JsonHelper::formatResponse($data, $httpCode);
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
            return ResponseHelper::getValidatorFailedResponse($validator);
        }

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

        return JsonHelper::formatResponse($data, $httpCode, $error);
    }

    public function delete(Request $request, string $id)
    {
        $deleteResult = Locations::destroy($id);
        return ResponseHelper::getDeleteResponse($deleteResult, $id);
    }


}
