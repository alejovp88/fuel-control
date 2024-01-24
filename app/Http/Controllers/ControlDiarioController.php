<?php

namespace App\Http\Controllers;

use App\Models\ControlDiario;
use App\Models\Rubro;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControlDiarioController extends Controller
{
    function index() {

        $rubros = Rubro::all();
        $controlDiario = ControlDiario::join('rubros', 'daily_control.rubro_id', 'rubros.id')
            ->select([
                'cedula',
                DB::raw("UPPER(placa) AS placa"),
                'nombre_chofer',
                'nombre_carnet_circulacion',
                'rubros.nombre',
                DB::raw("CASE tipo_combustible WHEN 0 THEN 'Gasolina' WHEN 1 THEN 'Diesel' END as tipo_combustible"),
                'litros'
            ])
            ->whereDate('daily_control.created_at', Carbon::now()->toDateString())
            ->orderBy('daily_control.created_at', 'desc')
            ->get();

        return view('control-diario')->with([
            'rubros' => $rubros,
            'controlDiario' => $controlDiario
        ]);
    }

    function store() {

        ControlDiario::create(request()->all());

        return redirect()
            ->back();
    }

    function getClientHistory() {

        $today = Carbon::now();
        $firstDay = $today->firstOfMonth();
        $lastDay  = Carbon::parse($today)->endOfMonth()->toDateString();
        $cedula = request()->has('cedula') ? request()->input('cedula') : null;
        $placa = request()->has('placa') ? strtoupper(request()->input('placa')) : null;

        if($cedula === null && $placa === null) {
            return [
                'data' => []
            ];
        }

        $historico = ControlDiario::join('rubros', 'daily_control.rubro_id', 'rubros.id')
                ->select([
                    'cedula',
                    DB::raw("UPPER(placa) AS placa"),
                    'nombre_chofer',
                    'nombre_carnet_circulacion',
                    'rubros.nombre',
                    DB::raw("CASE tipo_combustible WHEN 0 THEN 'Gasolina' WHEN 1 THEN 'Diesel' END AS tipo_combustible"),
                    'litros',
                    DB::raw("DATE_FORMAT(daily_control.created_at, '%d/%m/%Y') AS fecha_ult_surtido")
                ])->whereDate('daily_control.created_at', '>=', $firstDay)
                ->whereDate('daily_control.created_at', '<=', $lastDay);

        if($cedula !== null) {
            $historico->whereRaw("cedula LIKE '%{$cedula}%'");
        }

        if($placa !== null) {
            $historico->whereRaw("UPPER(placa) LIKE '%{$placa}%'");
        }

        $historico->orderBy('daily_control.id', 'DESC');

        return [
            'data' => $historico->get()
        ];
    }
}
