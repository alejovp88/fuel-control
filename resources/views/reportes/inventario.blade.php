@extends('layouts.app')

@section('pageTitle')
    Reporte Recepci&oacute;n Inventario
@endSection

@section('content')
    <div class="row p-3">
        <div class="col-12 p-3">
            <h1>Reporte Recepci&oacute;n Inventario</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <table class="table" id="reporte-diario-table">
                <thead>
                    <tr>
                        <th>Nro Factura</th>
                        <th>Monto Factura</th>
                        <th>Fecha Recepci&oacute;n</th>
                        <th>Total Litros</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($reporte as $row)
                    <tr>
                        <td>{{$row->nro_factura}}</td>
                        <td>{{number_format($row->monto_factura, 2, ',', '.')}}</td>
                        <td>{{$row->fecha_recepcion}}</td>
                        <td>{{number_format($row->total_litros, 0, '', '.')}}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                <a class="btn btn-outline-primary" title="Ver" href="{{route('reporte.inventario.detalle', ['inventario'=> $row->id])}}"><i class="far fa-eye"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

    </script>
@endpush
