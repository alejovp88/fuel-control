<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\InventarioItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecepcionInventarioController extends Controller
{
    function create() {

        $recepcion = Inventario::join('inventario_item', 'inventario_item.inventario_id', 'inventario.id')
            ->whereDate('inventario.fecha_recepcion', Carbon::now()->toDateString())
            ->select([
                'inventario.nro_factura',
                DB::raw("CASE inventario_item.tipo_combustible WHEN 0 THEN 'Gasolina' WHEN 1 THEN 'Diesel' END as tipo_combustible"),
                DB::raw("DATE_FORMAT(inventario.fecha_recepcion, '%d/%m/%Y') AS fecha_recepcion"),
                'inventario_item.litros'
            ])
            ->get();

        return view('inventario.create')->with([
            'recepcion' => $recepcion
        ]);
    }

    function store() {

        $fechaRecepcion = request()->input('fecha_recepcion');
        $fechaRecepcionData = explode("/", $fechaRecepcion);
        $fechaRecepcion = "$fechaRecepcionData[2]-$fechaRecepcionData[1]-$fechaRecepcionData[0]";

        $inventario = Inventario::create([
            'nro_factura' => request()->input('nro_factura'),
            'monto_factura' => request()->input('monto_factura'),
            'fecha_recepcion' => $fechaRecepcion,
            'procedencia' => request()->input('procedencia'),
            'chofer' => request()->input('chofer'),
            'observaciones' => request()->input('observaciones')
        ]);

        foreach (request()->input('tipo_combustible') as $key => $value) {
            InventarioItem::create([
                'inventario_id' => $inventario->id,
                'tipo_combustible' => $value,
                'litros' => request()->input('litros')[$key]
            ]);
        }

        return redirect()
            ->back();
    }
}
