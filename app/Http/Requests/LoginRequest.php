<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidatesWhenResolvedTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;


class LoginRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'correo',
            'password' => 'contraseña',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => "El :attribute es requerido",
            'email.email' => "El :attribute no es correcto",
            'email.unique' => "El :attribute debe ser único",
            'password.required' => "La :attribute es requerida",
            'password.min' => "La :attribute  debe contenter minimop 8 caracteres",
        ];
    }



}
