<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post("/login", [AuthController::class, "login"])->name("login");
Route::post("/register", [AuthController::class, "register"])->name("register");
Route::get("/profile", [AuthController::class, "profile"])->name("profile");
Route::post("/logout", [AuthController::class, "logout"])->name("logout");
Route::post("/forgot-password", [AuthController::class, "forgotPassword"])->name("password.forgot");
Route::post("/reset-password", [AuthController::class, "resetPassword"])->name("password.reset");