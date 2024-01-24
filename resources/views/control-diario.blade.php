@extends('layouts.app')

@section('pageTitle')
    Control Diario
@endSection

@section('content')
    <div class="row p-3">
        <div class="col-12 p-3">
            <h1>Control Diario</h1>
        </div>
    </div>
    <div class="row p-3">
        <div class="col-12">
            <h4>Datos Cliente Actual</h4>
            <form class="row g-3 needs-validation" novalidate action="{{ route('control.store') }}" method="post">
                @csrf
                <div class="col-md-2">
                    <label for="validationCustom01" class="form-label">C&eacute;dula</label>
                    <input type="text" class="form-control" id="cedula" name="cedula" value="" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="validationCustom02" class="form-label">Placa</label>
                    <input type="text" class="form-control" id="placa" name="placa" value="" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">Rubro</label>
                    <select class="form-select" id="rubro_id" name="rubro_id" required>
                        <option selected disabled value="">Seleccione...</option>
                        @foreach($rubros as $rubro)
                        <option value="{{$rubro->id}}">{{$rubro->nombre}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid state.
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="validationCustom05" class="form-label">Tipo Combustible</label>
                    <select class="form-select" id="tipo_combustible" name="tipo_combustible" required>
                        <option selected disabled value="">Seleccione...</option>
                        <option value="0">Gasolina</option>
                        <option value="1">Diesel</option>
                    </select>
                    <div class="invalid-feedback">
                        Please provide a valid zip.
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="validationCustom05" class="form-label">Litros</label>
                    <input type="text" class="form-control" id="litros" name="litros" required>
                    <div class="invalid-feedback">
                        Please provide a valid zip.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label">Nombre Chofer</label>
                    <input type="text" class="form-control" id="nombre_chofer" name="nombre_chofer" value="" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom03" class="form-label">Nombre Carnet Circulaci&oacute;n</label>
                    <input type="text" class="form-control" id="nombre_carnet_circulacion" name="nombre_carnet_circulacion" required>
                    <div class="invalid-feedback">
                        Please provide a valid city.
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Registrar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row p-3">
        <div class="col-12 mt-5">
            <h4>Hist&oacute;rico del Cliente Actual. Placa/ C&eacute;dula</h4>
            <table class="table" id="historico-cliente-table">
                <thead>
                    <tr>
                        <th>C&eacute;dula</th>
                        <th>Nombre Chofer</th>
                        <th>Placa</th>
                        <th>Nombre C/Circulaci&oacute;n</th>
                        <th>Rubro</th>
                        <th>Tipo</th>
                        <th>Litros</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-5 p-3">
        <div class="col-12 col-md-12 col-lg-12">
            <h4>Listado Surtido del D&iacute;a de Hoy</h4>
            <table class="table" id="control-diario-table">
                <thead>
                    <tr>
                        <th>C&eacute;dula</th>
                        <th>Nombre Chofer</th>
                        <th>Placa</th>
                        <th>Nombre C/Circulaci&oacute;n</th>
                        <th>Rubro</th>
                        <th>Tipo</th>
                        <th>Litros</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($controlDiario as $row)
                    <tr>
                        <td>{{$row->cedula}}</td>
                        <td>{{$row->nombre_chofer}}</td>
                        <td>{{$row->placa}}</td>
                        <td>{{$row->nombre_carnet_circulacion}}</td>
                        <td>{{$row->nombre}}</td>
                        <td>{{$row->tipo_combustible}}</td>
                        <td>{{$row->litros}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#control-diario-table').dataTable({
                "ordering": false,
                "language": {
                    "lengthMenu": "Mostrar _MENU_ Registros Por Página",
                    "zeroRecords": "No Hay Registros Disponibles",
                    "info": "Página _PAGE_ de _PAGES_",
                    "infoEmpty": "",
                    "infoFiltered": "(Filtro de _MAX_ Registros en Total)",
                    "sSearch": "Buscar",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "processing": "Procesando..."
                },
            });
            buscarHistoricoCLienteActual();

            $('#cedula').on('blur', function () {
                buscarHistoricoCLienteActual();
            });

            $('#placa').on('blur', function () {
                buscarHistoricoCLienteActual();
            });

            function buscarHistoricoCLienteActual() {
                let cedula = $('#cedula').val(),
                    placa  = $('#placa').val(),
                    dtUrl  = `/getClientHistory`;

                if(cedula) {
                    dtUrl += ((dtUrl.includes("?")) ? `&cedula=${cedula}` : `?cedula=${cedula}`);
                }

                if(placa) {
                    dtUrl += ((dtUrl.includes("?")) ? `&placa=${placa}` : `?placa=${placa}`);
                }

                $('#historico-cliente-table').dataTable({
                    "bDestroy": true,
                    "ordering": false,
                    "searching": false,
                    "language": {
                        "lengthMenu": "Mostrar _MENU_ Registros Por Página",
                        "zeroRecords": "No Hay Registros Disponibles",
                        "info": "Página _PAGE_ de _PAGES_",
                        "infoEmpty": "",
                        "infoFiltered": "(Filtro de _MAX_ Registros en Total)",
                        "sSearch": "Buscar",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "processing": "Procesando..."
                    },
                    "processing": true,
                    "ajax":{
                        "url": dtUrl
                    },
                    "columns": [
                        {data: 'cedula', name: 'cedula'},
                        {data: 'nombre_chofer', name: 'nombre_chofer'},
                        {data: 'placa', name: 'placa'},
                        {data: 'nombre_carnet_circulacion', name: 'nombre_carnet_circulacion'},
                        {data: 'nombre', name: 'nombre'},
                        {data: 'tipo_combustible', name: 'tipo_combustible'},
                        {data: 'litros', name: 'litros'},
                        {data: 'fecha_ult_surtido', name: 'fecha_ult_surtido'}
                    ],
                    responsive: true
                });
            }
        });
    </script>
@endpush
