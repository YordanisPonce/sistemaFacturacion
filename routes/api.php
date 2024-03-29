<?php

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


Route::group(
    [
        'prefix' => '/auth'
    ],
    base_path('routes/api/auth.php')
);

Route::group(
    [
        'prefix' => '/clients'
    ],
    base_path('routes/api/clients.php')
);
Route::group(
    [
        'prefix' => '/enterprises'
    ],
    base_path('routes/api/enterprises.php')
);
Route::group(
    [
        'prefix' => '/taxes'
    ],
    base_path('routes/api/taxes.php')
);
Route::group(
    [
        'prefix' => '/bills'
    ],
    base_path('routes/api/bills.php')
);


