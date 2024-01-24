<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarioItem extends Model
{
    use HasFactory;

    protected $table = "inventario_item";

    protected $fillable = [
        'inventario_id',
        'tipo_combustible',
        'litros'
    ];
}
