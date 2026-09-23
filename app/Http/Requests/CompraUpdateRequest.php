<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CompraUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_proveedor' => 'required|exists:proveedor,id',
            'metodo_pago' => 'required|in:tarjeta,transferencia,efectivo',
            'total' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'id_proveedor.required' => 'El proveedor es requerido.',
            'id_proveedor.exists' => 'El proveedor seleccionado no existe.',
            'metodo_pago.required' => 'El método de pago es requerido.',
            'metodo_pago.in' => 'El método de pago seleccionado no es válido.',
            'total.required' => 'El total de la compra es requerido.',
            'total.numeric' => 'El total debe ser un número.',
            'total.min' => 'El total no puede ser negativo.',
        ];
    }
}