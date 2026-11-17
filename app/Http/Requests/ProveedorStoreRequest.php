<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class ProveedorStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nit' => 'required|string',
            'cedula' => 'required|string|min:10',
            'nombre' => 'required|string',
            'telefono' => 'required|string|min:10',
            'direccion' => 'required|string',
            'correo' => 'required|email'
        ];
    }

    public function messages(): array
    {
        return [
            'nit.required' => 'El NIT del proveedor es requerido',
            'cedula.required' => 'La cedula del proveedor es requerida',
            'cedula.min' => 'La cedula debe tener al menos 10 caracteres',
            'nombre.required' => 'El nombre del proveedor es requerido',
            'telefono.required' => 'El telefono del proveedor es requerido',
            'telefono.min' => 'El telefono debe tener al menos 10 caracteres',
            'direccion.required' => 'La direccion del proveedor es requerida',
            'correo.required' => 'El correo del proveedor es requerido',
            'correo.email' => 'El correo debe tener un formato valido debe ser correo'
        ];
    }
}