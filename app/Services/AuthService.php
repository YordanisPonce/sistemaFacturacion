<?php

namespace App\Services;

use App\Helpers\ResponseHelper;
use App\Interfaces\EloquentUserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthService
{
    private $tokenName;
    public function __construct(
        private readonly EloquentUserRepositoryInterface $repository
    ) {
        $this->tokenName = 'accessToken';
    }

    public function register($attributes): JsonResponse
    {
        $user = $this->repository->save($attributes);

        throw_if(!$user, 'Ha ocurrido un error a la hora de completar el registro');
        // $this->httpService->post('/register', $user);
        Auth::login($user);
        $token = $user->createToken($user->email)->plainTextToken;
        return ResponseHelper::ok(
            "Registro completado satisfactoriamente",
            [
                $this->tokenName => $token,
                'user' => $user
            ]
        );
    }


    public function login($attributes): JsonResponse
    {
        if (!Auth::attempt($attributes)) {
            return ResponseHelper::fail("Correo o contraseña errónea", 403);
        }

        $user = $this->repository->findByEmail($attributes["email"]);


        $token = $user->createToken($this->tokenName)->plainTextToken;


        return ResponseHelper::ok("Acceso al sistema", [
            $this->tokenName => $token,
            'user' => $user
        ]);
    }

    public function logout(): JsonResponse
    {
        request()->user()->currentAccessToken()->delete();
        return ResponseHelper::ok("Sesion finalizada satisfactoriamente");
    }

    public function profile(): JsonResponse
    {
        $user = request()->user();

        throw_if(!$user, 'No se ha encontrado al usuario con el identificador proporcionado');
        return ResponseHelper::ok(
            "Perfil",
            [
                'user' => $user
            ]
        );
    }

    /**
     * @throws \Exception
     */
    public function forgotPassword(): JsonResponse
    {
        $email = request()->email;
        $user = $this->repository->findByEmail($email);

        if (!$user) {
            return ResponseHelper::fail("Usuario no encontrado", 404);
        }
        $user->sendPasswordResetLink();
        return ResponseHelper::ok("Verifique su cuenta de correo para resetear la contraseña");
    }

    /**
     * @throws \Exception
     */
    public function resetPassword(array $data): JsonResponse
    {
        $user = $this->repository->findByEmail($data['email']);

        if (!$user) {
            return ResponseHelper::fail("Usuario no encontrado", 404);
        }
        $user->resetPassword($data);
        return ResponseHelper::ok("Contraseña cambiada satisfactoriamente", [
            "user" => $user,
            $this->tokenName => $user->createToken($this->tokenName)->plainTextToken
        ]);
    }

}