<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class ProveedorStoreRequest extends FormRequest
{
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nit' => 'required|string',
            'cedula' => 'required|string',
            'nombre' => 'required|string',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
            'correo' => 'required|email'
        ];
    }

    public function messages(): array
    {
        return [
            'nit.required' => 'El NIT del proveedor es requerido',
            'cedula.required' => 'La cedula del proveedor es requerida',
            'nombre.required' => 'El nombre del proveedor es requerido',
            'telefono.required' => 'El telefono del proveedor es requerido',
            'direccion.required' => 'La direccion del proveedor es requerida',
            'correo.required' => 'El correo del proveedor es requerido',
            'correo.email' => 'El correo debe tener un formato valido'
        ];
    }
}