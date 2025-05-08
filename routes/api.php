<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', [App\Http\Controllers\Api\HomeController::class, 'index']);
Route::post('register', [App\Http\Controllers\Api\HomeController::class, 'register']);

Route::group(['middleware' => 'auth:sanctum'], function(){
    // Route::get('task', [App\Http\Controllers\Api\TaskController::class, 'index']);
    Route::apiResource('task', TaskController::class );
    Route::patch('/task/toggle-status/{id}', [App\Http\Controllers\Api\TaskController::class, 'toggleStatus']);
});
