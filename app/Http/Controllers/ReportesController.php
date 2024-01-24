<?php

namespace App\Http\Controllers;

use App\Models\ControlDiario;
use App\Models\Inventario;
use App\Models\InventarioItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportesController extends Controller
{
    function getReporteDiario() {

        $reporteDiario = ControlDiario::join('rubros', 'daily_control.rubro_id', 'rubros.id')
            ->select([
                DB::raw("SUM(daily_control.litros) as total_litros"),
                DB::raw("COUNT(daily_control.id) as total_clientes"),
                DB::raw("CASE tipo_combustible WHEN 0 THEN 'Gasolina' WHEN 1 THEN 'Diesel' END as tipo_combustible"),
                'rubros.nombre'
            ])
            ->whereDate('daily_control.created_at', Carbon::now()->toDateString())
            ->groupBy('rubros.nombre')
            ->groupBy('tipo_combustible')
            ->orderBy('daily_control.tipo_combustible', 'asc')
            ->get();

        return view('reportes.diario')->with([
            'reporte' => $reporteDiario
        ]);
    }

    function getReportePersonalizado() {
        return view('reportes.personalizado');
    }

    function getReportePersonalizadoInfo() {
        $fechaDesde = request()->input('fechaDesde');
        $fechaHasta = request()->input('fechaHasta');

        $reportePersonalizado = ControlDiario::join('rubros', 'daily_control.rubro_id', 'rubros.id')
            ->select([
                DB::raw("SUM(daily_control.litros) as total_litros"),
                DB::raw("COUNT(daily_control.id) as total_clientes"),
                DB::raw("CASE tipo_combustible WHEN 0 THEN 'Gasolina' WHEN 1 THEN 'Diesel' END as tipo_combustible"),
                'rubros.nombre',
                DB::raw("DATE_FORMAT(daily_control.created_at, '%d/%m/%Y') as fecha")
            ])
            ->whereRaw("DATE(daily_control.created_at) BETWEEN STR_TO_DATE('$fechaDesde', '%Y-%m-%d') AND STR_TO_DATE('$fechaHasta', '%Y-%m-%d')")
            ->groupBy('rubros.nombre')
            ->groupBy('tipo_combustible')
            ->groupBy('fecha')
            ->orderBy('fecha', 'desc')
            ->orderBy('daily_control.tipo_combustible', 'asc');

        return [
            'data' => $reportePersonalizado->get()
        ];
    }

    function getInventarioIndex() {

        $today = Carbon::now();
        $firstDay = $today->firstOfMonth();
        $lastDay  = Carbon::parse($today)->endOfMonth()->toDateString();

        $inventarioRecibido = Inventario::whereDate('fecha_recepcion', '>=', $firstDay)
            ->whereDate('fecha_recepcion', '<=', $lastDay)
            ->select([
                'id',
                'nro_factura',
                'monto_factura',
                DB::raw("DATE_FORMAT(fecha_recepcion, '%d/%m/%Y') AS fecha_recepcion"),
                DB::raw("(SELECT SUM(litros) FROM inventario_item WHERE inventario_id = inventario.id) AS total_litros")
            ])
            ->get();

        return view('reportes.inventario')->with([
            'reporte' => $inventarioRecibido
        ]);
    }

    function getInventarioDetail(Inventario $inventario) {

        $inventario->fecha_recepcion = date('d/m/Y', strtotime($inventario->fecha_recepcion));
        $inventario->items = InventarioItem::where("inventario_id", "=" , $inventario->id)->get();

        return view('reportes.inventario-detail')->with([
            'inventario' => $inventario
        ]);
    }
}
