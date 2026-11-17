<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImpuestoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string',
            'tipo_calculo' => 'required|in:porcentaje,fijo',
            'tipo_impuesto' => 'nullable|string',
            'estado' => 'required|boolean',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after:fecha_inicio',
            'porcentaje' => [
                'required',
                'numeric',
                'min:0',
                'max:' . ($this->input('tipo_calculo') === 'porcentaje' ? 1 : 999999999),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del impuesto es requerido.',

            'fecha_inicio.required' => 'La fecha de inicio es requerida.',

            'fecha_fin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',

            'porcentaje.required' => 'El porcentaje es requerido.',
            'porcentaje.min' => 'La tarifa no puede ser negativo.',

            'tipo_calculo.required' => 'El tipo de calculo es requereido',
            'estado.required' => 'el estado es requerido',
        ];
    }

    protected function prepareForValidation(): void
    {
        $tarifa = $this->input('porcentaje');

        if (
            $this->input('tipo_calculo') === 'porcentaje' &&
            is_numeric($tarifa)
        ) {
            $this->merge([
                'porcentaje' => (float) $tarifa / 100,
            ]);
        }
    }
}