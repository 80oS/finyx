<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImpuestoStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'porcentaje' => 'required|numeric|min:0|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del impuesto es requerido.',
            'nombre.string' => 'El nombre del impuesto debe ser texto.',
            'nombre.max' => 'El nombre del impuesto no puede superar los 255 caracteres.',

            'fecha_inicio.required' => 'La fecha de inicio es requerida.',
            'fecha_inicio.date' => 'La fecha de inicio no es válida.',

            'fecha_fin.date' => 'La fecha de fin no es válida.',
            'fecha_fin.after_or_equal' => 'La fecha de fin debe ser igual o posterior a la fecha de inicio.',

            'porcentaje.required' => 'El porcentaje es requerido.',
            'porcentaje.numeric' => 'El porcentaje debe ser un número.',
            'porcentaje.min' => 'El porcentaje no puede ser negativo.',
            'porcentaje.max' => 'El porcentaje no puede ser mayor al 100%.',
        ];
    }
}