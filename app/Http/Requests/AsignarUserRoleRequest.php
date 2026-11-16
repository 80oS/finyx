<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class AsignarUserRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'rol' => 'required',
            'guard_name' => 'required'
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            'name.required'  => 'nombre del rol requerido'
        ];
    }
}
