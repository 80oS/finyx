<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class RoleStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'guard_name' => 'required'
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'nombre del rol requerido',
        ];
    }
}
