<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password as RulesPassword;


/**
 * @OA\Schema(
 *     title="RegisterRequest",
 *     description="Request body parameters for register",
 *     required={"name", "email", "password"}
 * )
 */
class RegisterRequest extends FormRequest
{
    /**
     * @OA\Property(
     *     description="User's name",
     *     example="John Doe"
     * )
     *
     * @var string
     */
    public $name;

    /**
     * @OA\Property(
     *     description="User's email",
     *     example="example@example.com"
     * )
     *
     * @var string
     */
    public $email;

    /**
     * @OA\Property(
     *     description="User's password",
     *     example="PW*14587"
     * )
     *
     * @var string
     */
    public $password;

    /**
     * Determine if the user is authorized to make this request.
     */
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                'required',
                RulesPassword::min(6)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->numbers()
                    ->symbols()
            ],
            'name' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'email' => "cuenta de correo",
            'password' => "contraseña",
            'name' => 'nombre'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => "La :attribute es requerida",
            'email.email' => "La :attribute no es válida",
            'email.unique' => "La :attribute ya está registrada",
            'password.required' => "La :attribute es requerida",
            'password.min' => __("La :attribute debe tener al menos :min caracteres"),
            'password.mixed' => "La :attribute debe tener al menos una mayúscula y una minúscula",
            'password.numbers' => __("La :attribute debe tener al menos un número"),
            'password.symbols' => "La :attribute debe tener al menos un caracter especial",
            'password.letters' => "La :attribute debe tener al menos una letra",
            'name.required' => "El :attribute es requerido",
        ];
    }
}
