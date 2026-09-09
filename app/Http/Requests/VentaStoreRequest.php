<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class VentaStoreRequest extends FormRequest
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
            'codigo' => 'required',
            'id_cliente' => 'required|exists:cliente,id',
            'estado' => 'required|string',
            'observaciones' => 'nullable|string|max:100',
            'metodo_pago' => 'required|string',
            'total' => 'required',
            'productos' => 'required|array',
            'productos.*.id_producto' => 'required|integer|exists:producto,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio_unitario' => 'required|numeric',
            'productos.*.subtotal' => 'required|numeric'
        ];
    }

    #[Override]
    public function messages(): array
    {
        return[
            'codigo.required' => 'el codigo es requerido',
            'id_cliente.required' => 'el cliente es requerido',
            'estado.required' => 'el estado es requerido',
            'observaciones.max:100' => 'las observaciones no deben superar lo 100 caracteres',
            'metodo_pago.required' => 'el metodo pago es requerido',
            'total' => 'required',
            'productos.required' => 'los productos son requeridos',
            'productos.*.id_producto.required' => 'el id del producto es requerido',
            'productos.*.cantidad.required' => 'la cantidad del producto es requerido',
            'productos.*.precio_unitario.required' => 'el precio unitario del producto es requerido',
            'productos.*.subtotal.required' => 'el subtotal el producto es requerido'
        ];
    }
}
