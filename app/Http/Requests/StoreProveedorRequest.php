<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProveedorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Asegúrate de ajustar esto según la autorización requerida
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre_proveedor' => 'required|unique:proveedores,nombre_proveedor',
            'correo_proveedor' => 'required|email|unique:proveedores,correo_proveedor',
            'telefono_proveedor' => 'required|unique:proveedores,telefono_proveedor',
            'contacto_fiscal' => 'required',
            'direccion' => 'required',
        ];
    }
}
