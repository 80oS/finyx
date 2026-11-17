<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Override;

class AsignarUserRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'rol' => ['required', 'string', Rule::notIn(['Desarrollador']),
                Rule::exists('roles', 'name')->where('guard_name', 'web')]
        ];
    }

    #[Override]
    public function messages(): array
    {
        return [
            'rol.required' => 'Debes seleccionar un rol.',
            'rol.string' => 'El rol seleccionado no es válido.',
            'rol.max' => 'El nombre del rol es demasiado largo.',
            'rol.not_in' => 'No puedes asignar el rol Desarrollador.',
            'rol.exists' => 'El rol seleccionado no existe.',
        ];
    }

    public function attributes(): array
    {
        return [
            'rol' => 'rol',
        ];
    }
}
