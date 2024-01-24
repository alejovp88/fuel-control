<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inventario extends Model
{
    use HasFactory;

    protected $table = "inventario";

    protected $fillable = [
        'nro_factura',
        'monto_factura',
        'fecha_recepcion',
        'procedencia',
        'chofer',
        'observaciones'
    ];

}
