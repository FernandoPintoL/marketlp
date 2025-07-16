<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Services\PermissionService;
use App\Services\ResponseService;
use App\Traits\CrudController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ItemController extends Controller
{
    use CrudController;
    public Item $model;
    public $rutaVisita = 'Item';
    public function __construct()
    {
        $this->model = new Item();
    }
    // Sobrescribe handleRequest para manejar la subida de imágenes
    protected function handleRequest(Request $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo_path')) {
            // Manejar la subida de la imagen
            $file = $request->file('photo_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/items', $filename);
            $data['photo_path'] = 'items/' . $filename;
        }

        return $data;
    }
}
