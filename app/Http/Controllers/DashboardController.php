<?php

namespace App\Http\Controllers;

use App\Models\ControlDiario;
use App\Models\Inventario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function index () {
        return view('dashboard');
    }

    function getResumenVentas() {

        $today = Carbon::now();
        $firstDay = Carbon::now()->subDays(14);

        $fechas = ControlDiario::whereDate('daily_control.created_at', '>=', $firstDay)
            ->whereDate('daily_control.created_at', '<=', $today)
            ->select([
                DB::raw("DATE_FORMAT(daily_control.created_at, '%d/%m/%Y') AS fecha")
            ])
            ->groupBy('fecha')
            ->get();

        $ventasGasolina = ControlDiario::whereDate('daily_control.created_at', '>=', $firstDay)
            ->whereDate('daily_control.created_at', '<=', $today)
            ->where('tipo_combustible', '=', 0)
            ->select([
                DB::raw("SUM(daily_control.litros) as litros"),
                DB::raw("DATE_FORMAT(daily_control.created_at, '%d/%m/%Y') AS fecha")
            ])
            ->groupBy('fecha')
            ->get();

        $ventasDiesel = ControlDiario::whereDate('daily_control.created_at', '>=', $firstDay)
            ->whereDate('daily_control.created_at', '<=', $today)
            ->where('tipo_combustible', '=', 1)
            ->select([
                DB::raw("SUM(daily_control.litros) as litros"),
                DB::raw("DATE_FORMAT(daily_control.created_at, '%d/%m/%Y') AS fecha")
            ])
            ->groupBy('fecha')
            ->get();

        $ventasGasolinaData = [];
        foreach ($fechas as $row) {
            $found = false;
            foreach ($ventasGasolina as $value) {
                if($row->fecha === $value->fecha) {
                    $found = true;
                    $ventasGasolinaData[] = $value->litros;
                }
            }

            if(!$found) {
                $ventasGasolinaData[] = 0;
            }
        }

        $ventasDieselData = [];
        foreach ($fechas as $row) {
            $found = false;
            foreach ($ventasDiesel as $value) {
                if($row->fecha === $value->fecha) {
                    $found = true;
                    $ventasDieselData[] = $value->litros;
                }
            }

            if(!$found) {
                $ventasDieselData[] = 0;
            }
        }

        $fechasData = [];
        foreach ($fechas as $row) {
            $fechasData[] = $row->fecha;
        }

        $data = [
            'labels' => $fechasData,
            'gasolina' => $ventasGasolinaData,
            'diesel' => $ventasDieselData
        ];

        return $data;
    }

    function getResumenCompras() {

        $today = Carbon::now();
        $firstDay = Carbon::now()->subDays(14);

        $fechas = Inventario::join('inventario_item', 'inventario_item.inventario_id', 'inventario.id')
            ->whereDate('inventario.fecha_recepcion', '>=', $firstDay)
            ->whereDate('inventario.fecha_recepcion', '<=', $today)
            ->select([
                DB::raw("DATE_FORMAT(inventario.fecha_recepcion, '%d/%m/%Y') AS fecha")
            ])
            ->groupBy('fecha')
            ->get();

        $comprasGasolina = Inventario::join('inventario_item', 'inventario_item.inventario_id', 'inventario.id')
            ->whereDate('inventario.fecha_recepcion', '>=', $firstDay)
            ->whereDate('inventario.fecha_recepcion', '<=', $today)
            ->where('inventario_item.tipo_combustible', '=', 0)
            ->select([
                DB::raw("SUM(inventario_item.litros) as litros"),
                DB::raw("DATE_FORMAT(inventario.fecha_recepcion, '%d/%m/%Y') AS fecha")
            ])
            ->groupBy('fecha')
            ->get();

        $comprasDiesel = Inventario::join('inventario_item', 'inventario_item.inventario_id', 'inventario.id')
            ->whereDate('inventario.fecha_recepcion', '>=', $firstDay)
            ->whereDate('inventario.fecha_recepcion', '<=', $today)
            ->where('inventario_item.tipo_combustible', '=', 1)
            ->select([
                DB::raw("SUM(inventario_item.litros) as litros"),
                DB::raw("DATE_FORMAT(inventario.fecha_recepcion, '%d/%m/%Y') AS fecha")
            ])
            ->groupBy('fecha')
            ->get();

        $comprasGasolinaData = [];
        foreach ($fechas as $row) {
            $found = false;
            foreach ($comprasGasolina as $value) {
                if($row->fecha === $value->fecha) {
                    $found = true;
                    $comprasGasolinaData[] = $value->litros;
                }
            }

            if(!$found) {
                $comprasGasolinaData[] = 0;
            }
        }

        $comprasDieselData = [];
        foreach ($fechas as $row) {
            $found = false;
            foreach ($comprasDiesel as $value) {
                if($row->fecha === $value->fecha) {
                    $found = true;
                    $comprasDieselData[] = $value->litros;
                }
            }

            if(!$found) {
                $comprasDieselData[] = 0;
            }
        }

        $fechasData = [];
        foreach ($fechas as $row) {
            $fechasData[] = $row->fecha;
        }

        $data = [
            'labels' => $fechasData,
            'gasolina' => $comprasGasolinaData,
            'diesel' => $comprasDieselData
        ];

        return $data;
    }
}
