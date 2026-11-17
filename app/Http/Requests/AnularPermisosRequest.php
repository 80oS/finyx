<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class AnularPermisosRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'permisos' => 'required|array',
            'permisos.*' => 'required|integer|distinct|exists:permissions,id'
        ];
    }

    #[Override]
    public function messages(): array
    {
        return[
            'permisos.required' => 'permisos requeridos',
            'permisos.*.required' => 'los ids de los permisos son reqeridos',
            'permisos.*.distinct' => 'el permisos no deben se duplicados'
        ];
    }
}
