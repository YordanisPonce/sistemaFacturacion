<?php

use App\Http\Controllers\BillController;
use Illuminate\Support\Facades\Route;


Route::get('/', [BillController::class, 'index']);
Route::post('/', [BillController::class, 'store']);
Route::delete('/{id}', [BillController::class, 'destroy']);
