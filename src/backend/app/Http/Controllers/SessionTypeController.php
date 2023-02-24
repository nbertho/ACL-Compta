<?php

namespace App\Http\Controllers;

use App\Helpers\HttpCode;
use App\Helpers\JsonHelper;
use App\Helpers\ResponseHelper;
use App\Models\SessionType;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SessionTypeController extends Controller
{
    public function index(): string
    {
        $sessionList = SessionType::query()
            ->with(['locations'])
            ->get();
        return JsonHelper::formatResponse($sessionList);
    }

    public function create(Request $request): string
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                'length' => 'required',
                'price' => 'required',
                'location_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::getValidatorFailedResponse($validator);
        }

        try {
            $data = SessionType::query()->create($request->all());
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

    public function delete(string $id): string
    {

        $deleteResult = SessionType::destroy($id);

        return ResponseHelper::getDeleteResponse($deleteResult, $id, 'Session');
    }

    public function update(Request $request, string $id): string
    {
        $error = false;
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                'length' => 'required',
                'price' => 'required',
                'location_id' => 'required',
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::getValidatorFailedResponse($validator);
        }

        try {
            $updateData = SessionType::query()
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
}
