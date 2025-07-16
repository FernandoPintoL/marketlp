<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriaItem extends Model
{
    /** @use HasFactory<\Database\Factories\GaleriaItemFactory> */
    use HasFactory;
    protected $table = "galeria_items";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = [
        'item_id',
        'photo_path',
    ];
    /**
     * Get the item that owns the GaleriaItem.
     */
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
