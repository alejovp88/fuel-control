@extends('layouts.app')

@section('pageTitle')
    Reporte Diario
@endSection

@section('content')
    <div class="row pt-3 pb-3">
        <div class="col-12 p-3">
            <h1>Reporte Personalizado</h1>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-5 col-md-5">
            <label>Seleccione el Rango de Fechas</label><br>
            <input class="form-control custom-select-gris" id="global_daterange" type="text">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 col-md-12 col-lg-12">
            <table class="table" id="reporte-personalizado-table">
                <thead>
                    <tr>
                        <th>Rubro</th>
                        <th>Nro Clientes</th>
                        <th>Tipo Combustible</th>
                        <th>Total Litros</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {

            setDateRangePicker();

            function setDateRangePicker() {
                var startDate = moment().subtract(1, 'week').startOf('day');
                var endDate = moment().endOf('day');

                $('#global_daterange').daterangepicker({
                    opens: 'left',
                    startDate: startDate,
                    endDate: endDate,
                    locale: {
                        format: 'DD/MM/YYYY',
                        daysOfWeek: [
                            "Do",
                            "Lu",
                            "Ma",
                            "Mi",
                            "Ju",
                            "Vi",
                            "Sa"
                        ],
                        monthNames: [
                            "Enero",
                            "Febrero",
                            "Marzo",
                            "Abril",
                            "Mayo",
                            "Junio",
                            "Julio",
                            "Agosto",
                            "Septiembre",
                            "Octubre",
                            "Noviembre",
                            "Deciembre"
                        ],
                        applyLabel: "Aplicar",
                        cancelLabel: "Cancelar",
                    }
                }, function (start, end) {
                    startDate = start.startOf('day');
                    endDate = end.endOf('day');

                    getCustomReport(startDate.format("YYYY-MM-DD"), endDate.format("YYYY-MM-DD"));
                });

                getCustomReport(startDate.format("YYYY-MM-DD"), endDate.format("YYYY-MM-DD"));
            }

            function getCustomReport(startDate, endDate) {

                let dtUrl = `/reportes/personalizado/info?fechaDesde=${startDate}&fechaHasta=${endDate}`;

                console.log(dtUrl);

                $('#reporte-personalizado-table').dataTable({
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
                            "sFirst": "Primero",
                            "sLast": "Último",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "processing": "Procesando..."
                    },
                    "processing": true,
                    "ajax":{
                        "url": dtUrl
                    },
                    "columns": [
                        {data: 'nombre', name: 'nombre'},
                        {data: 'total_clientes', name: 'total_clientes'},
                        {data: 'tipo_combustible', name: 'tipo_combustible'},
                        {data: 'total_litros', name: 'total_litros'},
                        {data: 'fecha', name: 'fecha'}
                    ],
                });
            }
        });
    </script>
@endpush
