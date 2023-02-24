<?php

namespace App\Http\Controllers;

use App\Helpers\HttpCode;
use App\Helpers\JsonHelper;
use App\Helpers\ResponseHelper;
use App\Models\Patient;
use App\Models\Session;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PatientsController extends Controller
{

    public function index(): string
    {
        $patientList = Patient::query()
            ->orderBy('lastname', 'ASC')
            ->get();
        return JsonHelper::formatResponse($patientList);
    }

    public function show(string $patientId): string
    {
        $session = Patient::query()
            ->where('id', '=', $patientId)
            ->first();
        return JsonHelper::formatResponse($session);
    }

    public function create(Request $request): string
    {
        $validator = Validator::make(
            $request->all(),
            [
                'firstname' => 'required',
                'lastname' => 'required',
                'birth_date' => 'required|date_format:Y-m-d H:i:s',
                'description' => 'required',
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::getValidatorFailedResponse($validator);
        }

        try {
            $data = Patient::query()->create($request->all());
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

        $deleteResult = Patient::destroy($id);

        return ResponseHelper::getDeleteResponse($deleteResult, $id, 'Patient');
    }

    public function update(Request $request, string $id): string
    {
        $error = false;
        $validator = Validator::make(
            $request->all(),
            [
                'firstname' => 'required',
                'lastname' => 'required',
                'birth_date' => 'required|date_format:Y-m-d H:i:s',
                'description' => 'required',
            ]
        );
        if ($validator->fails()) {
            return ResponseHelper::getValidatorFailedResponse($validator);
        }

        try {
            $updateData = Patient::query()
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

    public function getPatientSessions($patientId)
    {
        $list = Session::query()
            ->where('patient_id', '=', $patientId)
            ->with('session_type', 'session_type.locations')
            ->get();
        return JsonHelper::formatResponse($list);
    }

}
