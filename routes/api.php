<?php

use App\Http\Controllers\Api\SubdivisionsController;
use App\Http\Controllers\Api\CompleteRenovationObjectsController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

Route::get('/subdivisions', [SubdivisionsController::class, 'index']);
Route::get('/subdivisions/{id}', [SubdivisionsController::class, 'show']);
Route::post('/subdivisions', [SubdivisionsController::class, 'store']);
Route::put('/subdivisions/{id}', [SubdivisionsController::class, 'update']);
Route::delete('/subdivisions/{id}', [SubdivisionsController::class, 'destroy']);



Route::get('/complete_renovation_objects', [CompleteRenovationObjectsController::class, 'index']);
Route::get('/complete_renovation_objects/{id}', [CompleteRenovationObjectsController::class, 'show']);
Route::post('/complete_renovation_objects', [CompleteRenovationObjectsController::class, 'store']);
Route::put('/complete_renovation_objects/{id}', [CompleteRenovationObjectsController::class, 'update']);
Route::delete('/complete_renovation_objects/{id}', [CompleteRenovationObjectsController::class, 'destroy']);
