@extends('layouts.app')

@section('pageTitle')
    Detalle Recepci&oacute;n de Inventario
@endSection

@section('content')
    <div class="row p-3">
        <div class="col-12 p-3">
            <h1>Detalle Recepci&oacute;n de Inventario</h1>
        </div>
    </div>
    <div class="row p-3">
        <div class="col-12">
            <form class="row g-3 needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label" style="font-weight: bolder">Numero Factura</label><br>
                        <label>{{ $inventario->nro_factura }}</label>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" style="font-weight: bolder">Monto Factura</label><br>
                        <label>{{ number_format($inventario->monto_factura, 2, ',', '.') }}</label>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" style="font-weight: bolder">Fecha Recepci&oacute;n</label><br>
                        <label>{{ $inventario->fecha_recepcion }}</label>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label" style="font-weight: bolder">Procedencia</label><br>
                        <label>{{ $inventario->procedencia }}</label>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label class="form-label" style="font-weight: bolder">Nombre Chofer</label><br>
                        <label>{{ $inventario->chofer }}</label>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label" style="font-weight: bolder">Observaciones</label><br>
                        <label>{{ $inventario->observaciones }}</label>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div>
                            <label style="font-weight: 700; font-size: 28px">Items</label>
                        </div>
                        <table class="table" id="inventario_items_table">
                            <thead>
                                <tr>
                                    <th>Tipo Combustible</th>
                                    <th>Litros</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $inventario->items as $row)
                                <tr>
                                    <td>{{ (($row->tipo_combustible == 0) ? "Gasolina" : "Diesel") }}</td>
                                    <td>{{ $row->litros }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <a class="btn btn-link" href="{{route('reporte.inventario')}}">Volver</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {

        });
    </script>
@endpush
