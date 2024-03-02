<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\AuthService;

/**
 * @OA\Info(title="Authentication", version="1.0")
 *
 * @OA\Server(url="http://localhost:8000")
 */
class AuthController extends Controller
{
    public function __construct(private readonly AuthService $service)
    {
        $this->middleware("auth:sanctum", ["only" => ["profile", "logout"]]);
    }

    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="Login",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Accesso al sistema"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Correo o contraseña errónea"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function login(LoginRequest $request)
    {
        try {
            $credentials = $request->only("email", "password");
            return $this->service->login($credentials);
        } catch (\Throwable $th) {
            return ResponseHelper::fail($th->getMessage());
        }
    }

    /**
     * @OA\Post(
     *     path="/api/auth/register",
     *     summary="Register",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Registro completado satisfactoriamente"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error a la hora de completar el registro"
     *     )
     * )
     */
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
