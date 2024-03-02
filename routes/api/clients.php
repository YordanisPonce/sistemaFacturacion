<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ClientController::class, 'index']);
Route::post('/', [ClientController::class, 'store']);
Route::put('/{id}', [ClientController::class, 'update']);
Route::delete('/{id}', [ClientController::class, 'destroy']);
