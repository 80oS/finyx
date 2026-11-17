<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|unique:users,name',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|string|min:8'
        ];
    }

    #[Override]
    public function messages()
    {
        return[
            'name.required' => 'nombre requerido',
            'name.unique' => 'el nombre de usuario ya está registrado.',
            'email.required' => 'El correo electrónico es requerido.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.required' => 'contraseña requerida',
            'password.min' => 'la contraseña debe tener minimo ocho caracteres'
        ];
    }
}
