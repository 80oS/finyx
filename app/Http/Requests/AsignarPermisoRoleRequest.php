<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Override;

class AsignarPermisoRoleRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'permisos' => 'required|array',
            'permisos.*' => 
                ['required', 
                'string', 
                'distinct', 
                Rule::exists('permissions', 'name')
                    ->where('guard_name', 'web')
                ]
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'permisos.required' => 'permisos requeridos',
            'permisos.*.required' => 'uno de los permisos esta vacio',
            'permisos.*.distinct' => 'No puedes seleccionar permisos duplicados.',
            'permisos.*.exists' => 'Uno de los permisos seleccionados no existe.'
        ];
    }
}
