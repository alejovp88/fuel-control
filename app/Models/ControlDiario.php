<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControlDiario extends Model
{
    use HasFactory;

    protected $table = "daily_control";

    protected $fillable = [
        'cedula',
        'placa',
        'nombre_chofer',
        'nombre_carnet_circulacion',
        'rubro_id',
        'tipo_combustible',
        'litros'
    ];
}
