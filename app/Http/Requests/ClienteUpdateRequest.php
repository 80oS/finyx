<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class ClienteUpdateRequest extends FormRequest
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
            'nombre' => 'required|string',
            'cedula' => 'required|string',
            'telefono' => 'required|string',
            'correo' => 'required|string',
            'direccion' => 'required|string',
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
