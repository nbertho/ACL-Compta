<?php

namespace App\Http\Controllers;

use App\Helpers\HttpCode;
use App\Helpers\JsonHelper;
use App\Helpers\ResponseHelper;
use App\Models\Session;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{

    public function index(): string
    {
        $sessionList = Session::query()
            ->orderBy('date', 'DESC')
            ->with(['patients', 'session_type', 'session_type.locations'])
            ->get();
        return JsonHelper::formatResponse($sessionList);
    }

    public function show(string $sessionId): string
    {
        $session = Session::query()
            ->where('id', '=', $sessionId)
            ->with(['patients', 'session_type', 'session_type.locations'])
            ->first();
        return JsonHelper::formatResponse($session);
    }

    public function create(Request $request): string
    {
        $validator = Validator::make(
            $request->all(),
            [
                'date' => 'required|date_format:Y-m-d H:i:s',
                'patient_id' => 'required',
                'session_type_id' => 'required',
                'is_present' => 'required',
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::getValidatorFailedResponse($validator);
        }

        try {
            $data = Session::query()->create($request->all());
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

        $deleteResult = Session::destroy($id);

        return ResponseHelper::getDeleteResponse($deleteResult, $id, 'Session');
    }

    public function update(Request $request, string $id): string
    {
        $error = false;
        $validator = Validator::make(
            $request->all(),
            [
                'date' => 'required|date_format:Y-m-d H:i:s',
                'patient_id' => 'required',
                'session_type_id' => 'required',
                'is_present' => 'required',
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::getValidatorFailedResponse($validator);
        }

        try {
            $updateData = Session::query()
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
