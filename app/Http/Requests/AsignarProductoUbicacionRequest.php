<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class AsignarProductoUbicacionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'productos' => 'required|array|min:1',
            'productos.*.id_producto' => 'required|integer|distinct|exists:producto,id',
            'productos.*.cantidad' => 'required|integer|min:1'
        ];
    }

    #[Override]
    public function messages()
    {
        return[
            'productos.required' => 'los productos son requeridos',
            'productos.*.id_producto.required' => 'el id del producto es requerido', 
            'productos.*.cantidad.required' => 'la cantidad del producto es requerida'
        ];
    }
}
