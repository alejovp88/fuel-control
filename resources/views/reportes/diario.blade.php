@extends('layouts.app')

@section('pageTitle')
    Reporte Diario
@endSection

@section('content')
    <div class="row p-3">
        <div class="col-12 p-3">
            <h1>Reporte Diario</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <table class="table" id="reporte-diario-table">
                <thead>
                    <tr>
                        <th>Rubro</th>
                        <th>Nro Clientes</th>
                        <th>Tipo Combustible</th>
                        <th>Total Litros</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($reporte as $row)
                    <tr>
                        <td>{{$row->nombre}}</td>
                        <td>{{$row->total_clientes}}</td>
                        <td>{{$row->tipo_combustible}}</td>
                        <td>{{$row->total_litros}}</td>
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
