<?php

use App\Http\Controllers\SessionController;
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

Route::get('/sessions', [SessionController::class, 'index']);

Route::get('/session/{session}', [SessionController::class, 'show']);
Route::post('/session/create', [SessionController::class, 'create']);
Route::put('/session/update/{session_id}', [SessionController::class, 'update']);
Route::delete('/session/delete/{session_id}', [SessionController::class, 'delete']);
