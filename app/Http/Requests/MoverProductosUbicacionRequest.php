<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use Override;

class MoverProductosUbicacionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_destino' => ['required', 'integer', Rule::exists('ubicacion', 'id')->where('estado', 'activa')],
            'productos' => 'required|required|array',
            'productos.*.id_producto' => 'required|integer|distinct|exists:producto,id',
            'productos.*.seleccionado' => 'required|boolean',
            'productos.*.cantidad' => 'required_if:productos.*.seleccionados,1|nullable|integer|min:1'
        ];
    }

    public function after(): array
    {
        return[
            function (Validator $validator) {
                $productos = $this->input('productos', []);

                $seleccionados = collect($productos)
                ->filter(fn ($producto) =>
                    isset($producto['seleccionado']) && 
                    (int) $producto['seleccionado'] === 1);

                if($seleccionados->isEmpty()){
                    $validator->errors()->add(
                        'productos', 'Selecciona al menos un producto para mover.'
                    );
                }
            }
        ];
    }

    public function messages(): array
    {
        return [
            'id_destino.required' => 'Selecciona una ubicación de destino.',
            'id_destino.exists' => 'La ubicación seleccionada no existe o está inactiva.',

            'productos.required' => 'Debes seleccionar al menos un producto.',
            'productos.min' => 'Debes seleccionar al menos un producto.',

            'productos.*.id_producto.exists' => 'Uno de los productos seleccionados no existe.',
            'productos.*.id_producto.distinct' => 'No puedes seleccionar un producto más de una vez.',

            'productos.*.cantidad.required' => 'La cantidad es obligatoria.',
            'productos.*.cantidad.integer' => 'La cantidad debe ser un número entero.',
            'productos.*.cantidad.min' => 'La cantidad debe ser como mínimo 1.',
        ];
    }
}
