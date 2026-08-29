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
            'cedula' => 'required',
            'nombre' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'correo' => 'required|email',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'nombre del cliente es requerido',
            'cedula.required' => 'cedula del cliente es requerido',
            'telefono.required' => 'telefono del cliente es requerido',
            'correo.required' => 'correo del cliente es requerido',
            'direccion.required' => 'direccion del cliente es requerido',

        ];
    }
}