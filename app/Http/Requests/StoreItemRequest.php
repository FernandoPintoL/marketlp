<?php

namespace App\Http\Requests;

use App\Services\PermissionService;
use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return PermissionService::havePermission('item-store');    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cod_barra' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'photo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024', // max 1MB
            'categoria_id' => 'required|exists:categorias,id',
            'unidad_id' => 'required|exists:unidads,id',
        ];
    }
}
