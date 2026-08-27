<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProveedorUpdateRequest extends FormRequest
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
            'nit.required' => 'el nit del proveedor es requerido',
            'cedula.required' => 'la cedula del proveedor es requerida',
            'nombre.required' => 'el nombre del proveedor es requerido',
            'telefono.required' => 'el telefono del proveedor es requerido',
            'direccion.required' => 'la direccion del proveedor es requerida',
            'correo.required' => 'el correo del proveedor es requerido',
            'correo.email' => 'el correo debe tener un formato valido'
        ];
    }
}