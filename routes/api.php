<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RestaurantStaffController;
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
Route::get('/employees/{employee}', [EmployeeController::class, 'fetch']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/employees', [EmployeeController::class, 'create']);
    Route::patch('/employees/{employee}', [EmployeeController::class, 'update']);
    Route::delete('/employees/{employee}', [EmployeeController::class, 'delete']);

    Route::post('/employees/attach/{restaurant}', [RestaurantStaffController::class, 'attachEmployees']);
    Route::post('/employees/detach/{restaurant}', [RestaurantStaffController::class, 'detachEmployees']);
});
