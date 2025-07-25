<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /** @use HasFactory<\Database\Factories\MenuFactory> */
    use HasFactory;
    protected $table = "menus";
    protected $primaryKey = "id";
    protected $fillable = [
        'title',
        'ruta',
        'icon',
        'isMain'
    ];
    public function submenus()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }
}
