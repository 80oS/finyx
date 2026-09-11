<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductoUpdateRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'nombre' => 'required|string',
            'codigo' => 'required|string',
            'barcode' => 'required|string',
            'precio_unitario' => 'required',
            'stock' => 'required|integer',
            'fecha_vencimiento' => 'nullable|date',
            'ubicacion_real' => 'nullable|string',
            'estado' => 'required|boolean',
            'id_categoria' => 'required|exists:categoria,id'
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'campo nombre requerido',
            'codigo.required' => 'campo codigo requerido',
            'barcode.required' => 'campo codigo de barras requerido',
            'precio_unitario.required' => 'campo precio unitario requerido',
            'stock.required' => 'campo stock requerido',
            'estado.required' => 'campo estado requerido',
            'id_categoria.required' => 'campo categoria requerido'
        ];
    }
}
