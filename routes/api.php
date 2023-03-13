<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SessionTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Sessions routes
Route::get('/sessions', [SessionController::class, 'index']);
Route::get('/session/{session}', [SessionController::class, 'show']);
Route::post('/session/create', [SessionController::class, 'create']);
Route::put('/session/update/{session_id}', [SessionController::class, 'update']);
Route::delete('/session/delete/{session_id}', [SessionController::class, 'delete']);

// Sessions type route
Route::get('/session-types', [SessionTypeController::class, 'index']);
Route::post('/session-type/create', [SessionTypeController::class, 'create']);
Route::put('/session-type/update/{session_type_id}', [SessionTypeController::class, 'update']);
Route::delete('/session-type/delete/{session_type_id}', [SessionTypeController::class, 'delete']);

// Location routes
Route::get('/locations', [LocationController::class, 'index']);
Route::post('/locations/create', [LocationController::class, 'create']);
Route::put('/locations/update/{location_id}', [LocationController::class, 'update']);
Route::delete('/locations/delete/{location_id}', [LocationController::class, 'delete']);

// Patients routes
Route::get('/patients', [PatientsController::class, 'index']);
Route::get('/patient/{patients}', [PatientsController::class, 'show']);
Route::post('/patient/create', [PatientsController::class, 'create']);
Route::put('/patient/update/{patient_id}', [PatientsController::class, 'update']);
Route::delete('/patient/delete/{patient_id}', [PatientsController::class, 'delete']);
Route::get('/patient/sessions/list/{patient_id}', [PatientsController::class, 'getPatientSessions']);
