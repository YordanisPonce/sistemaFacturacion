<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\EnterpriseController;
use Illuminate\Support\Facades\Route;


Route::get('/', [EnterpriseController::class, 'index']);
Route::post('/', [EnterpriseController::class, 'store']);
Route::put('/{id}', [EnterpriseController::class, 'update']);
Route::delete('/{id}', [EnterpriseController::class, 'destroy']);
