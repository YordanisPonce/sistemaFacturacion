<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $service)
    {
        $this->middleware("auth:sanctum", ["only" => ["profile", "logout"]]);
    }

    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only("email", "password");
            return $this->service->login($credentials);
        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }

    public function register(RegisterRequest $request)
    {
        try {
            return $this->service->register($request->all());
        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }

    public function profile()
    {
        try {
            return $this->service->profile();
        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }

    public function logout()
    {
        try {
            return $this->service->logout();
        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        try {
            return $this->service->forgotPassword();
        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $attributes = [
                'email' => $request->email,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation,
                'token' => $request->token
            ];
            return $this->service->resetPassword($attributes);
        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }


}
