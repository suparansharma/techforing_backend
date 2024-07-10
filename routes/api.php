<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Jobcontroller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', [AuthController::class,'login']);
Route::post('/register', [UserController::class,'register']);
Route::get('/showAlljobs', [JobController::class, 'getAllJobs']);

Route::group(['middleware' => 'api',], function ($router) {

    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);
    Route::post('/addJob', [Jobcontroller::class,'addJob']);
    Route::put('/updateJob/{id}', [JobController::class, 'updateJob']);
    Route::delete('/deleteJob/{id}', [JobController::class, 'deleteJob']);
    Route::get('/jobs', [JobController::class, 'getAllJobs']);
    Route::get('/job/{id}', [JobController::class, 'getJobInfo']);




});