<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cedula' => 'required|min:10',
            'nombre' => 'required',
            'telefono' => 'required|min:10',
            'direccion' => 'required',
            'correo' => 'required|email',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'nombre del cliente es requerido',
            'cedula.required' => 'cedula del cliente es requerido',
            'cedula.min' => 'el numero de cedula debe tener al menos 10 caracteres',
            'telefono.required' => 'telefono del cliente es requerido',
            'telefono.min' => 'el telefono debe tener al menos 10 caracteres',
            'correo.required' => 'correo del cliente es requerido',
            'correo.email' => 'El correo debe tener un formato valido debe ser correo',
            'direccion.required' => 'direccion del cliente es requerido',

        ];
    }
}