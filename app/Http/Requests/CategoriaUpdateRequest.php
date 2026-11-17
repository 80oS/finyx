<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CategoriaUpdateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'estado' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'nombre de la ctegoria es requerido',
            'descripcion.required' => 'descripcion de la categoria requerida',
            'estado.required' => 'el estado es requerido'
        ];
    }
}
