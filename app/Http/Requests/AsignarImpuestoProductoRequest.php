<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class AsignarImpuestoProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'productos' => 'required|array',
            'productos.*.id_producto' => 'required|integer|exists:producto,id|distinct',
            'tarifa_aplicada' => 'required|numeric',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after:fecha_inicio',
            'estado' => 'required|boolean',
        ];
    }

    #[Override]
    public function messages(): array
    {
        return[
            'productos.required' => 'Productos requeridos',
            'productos.*.id_producto.required' => 'ids de lo producto requerido',
            'productos.*.id_producto.distinct' =>'No puedes asignar el mismo producto más de una vez al mismo impuesto.',
            'tarifa_aplicada.required' => 'valor del impuesto requerido',
            'fecha_inicio.required' => 'facha inicio requerida',
            'fecha_fin.after:fecha_inicio' => 'la fecha final debe ser posterior a la fecha inicio',
            'estado.required' => 'estado requerido',
        ];
    }
}
