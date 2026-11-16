<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UbicacionUpdateRequest extends FormRequest
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
            'codigo' => 'required|string|distinct',
            'nombre' => 'required|string',
            'descripcion' => 'nullable|string',
            'tipo' => 'required|string',
            'estado' => 'required|string|in:activa,inactiva',
            'capacidad' => 'nullable|numeric|gt:0',
            'unidad_capacidad' => 'nullable|string',
            'id_ubicacion_padre' => 'nullable|exists:ubicacion,id'
        ];
    }


    public function messages()
    {
        return [
            'codigo.required' => 'cogigo obligatorio único y máximo 30 caracteres',
            'codigo.distinct' => 'El codigo debe ser unico, este codigo ya esta creado',
            'nombre.required' => 'nombre obligatorio, máximo 100 caracteres',
            'tipo.required' => 'tipo de hubicacion obligatorio, con opciones predefinidas',
            'estado,required' => 'el estado debe ser valor permitido, por ejemplo activa o inactiva',
            'capacidad' => 'capacidad debe ser un valor positivo',
            'unidad_capacidad' => 'unidad de la capacidad, coherente con la capacidad',
            'id_ubicacion_padre' => 'ubicacion padre debe exiztir en las tabla de ubicaciones y no ser la misma a la creada'
        ];
    }
}
