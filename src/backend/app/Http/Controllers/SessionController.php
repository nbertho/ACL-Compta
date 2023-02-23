<?php

namespace App\Http\Controllers;

use App\Helpers\HttpCode;
use App\Helpers\JsonHelper;
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
            ->take(5)
            ->get();
        return JsonHelper::formatResponse($sessionList, 200);
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
                $data = Session::query()->create($request->all());
                $httpCode = HttpCode::CREATED;
            } catch (QueryException $exception) {
                $httpCode = HttpCode::DB_ERROR;
                $error = true;
                $data = ['msg' => $exception->getMessage()];
            }
        }

        return JsonHelper::formatResponse($data, $httpCode, $error);

    }

    public function delete(Request $request, string $id): string
    {

        $deleteResult = Session::destroy($id);
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
        }
        return JsonHelper::formatResponse($data, $httpCode, $error);
    }
}
