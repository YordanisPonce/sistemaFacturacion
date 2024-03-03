<?php
use App\Http\Controllers\TaxController;
use Illuminate\Support\Facades\Route;


Route::get('/', [TaxController::class, 'index']);
Route::get('/find-by-enterprise/{enterpriseId}', [TaxController::class, 'findByEnterprise']);
Route::post('/', [TaxController::class, 'store']);
Route::put('/{id}', [TaxController::class, 'update']);
Route::delete('/{id}', [TaxController::class, 'destroy']);
