<?php

use App\Http\Controllers\Api\BalanceController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\OperationLatestController;
use App\Http\Controllers\Api\OperationListController;
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

Route::post('/login', LoginController::class)->name('login');
Route::middleware('auth:sanctum')->group(function (){
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', function (){
        auth()->user()->tokens()->delete();
        return response()->json();
    });

    Route::post('/balance', BalanceController::class)->name('balance');
    Route::post('/operations', OperationLatestController::class)->name('operation.latest');
    Route::post('/operations/list', OperationListController::class)->name('operation.list');
});
