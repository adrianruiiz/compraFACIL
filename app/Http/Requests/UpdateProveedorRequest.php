<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProveedorRequest extends FormRequest
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
        // Obtener el ID del proveedor desde la solicitud
        $id_proveedor = $this->input('id_proveedor');

        // Debugging: Imprime el ID para verificar
        \Log::info('ID Proveedor REQUEST: ' . $id_proveedor);

        return [
            'nombre_proveedor' => [
                'required',
                'string',
                'max:255',
                Rule::unique('proveedores', 'nombre_proveedor')->ignore($id_proveedor, 'id_proveedor')
            ],
            'correo_proveedor' => [
                'required',
                'email',
                Rule::unique('proveedores', 'correo_proveedor')->ignore($id_proveedor, 'id_proveedor')
            ],
            'telefono_proveedor' => [
                'required',
                Rule::unique('proveedores', 'telefono_proveedor')->ignore($id_proveedor, 'id_proveedor')
            ],
            'contacto_fiscal' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
        ];
    }
    
    /**
     * Get the custom validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nombre_proveedor.required' => 'El campo nombre de proveedor es obligatorio.',
            'nombre_proveedor.string' => 'El campo nombre de proveedor debe ser una cadena de caracteres.',
            'nombre_proveedor.max' => 'El campo nombre de proveedor no debe exceder los 255 caracteres.',
            'nombre_proveedor.unique' => 'El nombre de proveedor ya está en uso.',
            'correo_proveedor.required' => 'El campo correo electrónico es obligatorio.',
            'correo_proveedor.email' => 'El campo correo electrónico debe ser una dirección de correo válida.',
            'correo_proveedor.unique' => 'El correo electrónico ya está en uso.',
            'telefono_proveedor.required' => 'El campo teléfono es obligatorio.',
            'telefono_proveedor.unique' => 'El número de teléfono ya está en uso.',
            'contacto_fiscal.required' => 'El campo contacto fiscal es obligatorio.',
            'contacto_fiscal.string' => 'El campo contacto fiscal debe ser una cadena de caracteres.',
            'contacto_fiscal.max' => 'El campo contacto fiscal no debe exceder los 255 caracteres.',
            'direccion.required' => 'El campo dirección es obligatorio.',
            'direccion.string' => 'El campo dirección debe ser una cadena de caracteres.',
            'direccion.max' => 'El campo dirección no debe exceder los 255 caracteres.',
        ];
    }
}
