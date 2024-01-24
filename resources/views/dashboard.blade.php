@extends('layouts.app')

@section('pageTitle')
    Tablero
@endSection

@section('content')
    <div class="row p-3">
        <div class="col-12 p-3">
            <h1>Tablero</h1>
        </div>
    </div>
    <div class="row">
        <figure class="highcharts-figure">
            <div id="ventas-chart"></div>
        </figure>
    </div>
    <div class="row">
        <figure class="highcharts-figure">
            <div id="compras-chart"></div>
        </figure>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {

            crearVentasChart();
            crearComprasChart();

            function crearVentasChart() {

                axios.get("/dashboard/getResumenVentas")
                    .then(({data}) => {

                        Highcharts.chart('ventas-chart', {
                            chart: {
                                type: 'line'
                            },
                            title: {
                                text: 'Resumen de Ventas'
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {
                                categories: data.labels
                            },
                            yAxis: {
                                title: {
                                    text: 'Litros'
                                }
                            },
                            plotOptions: {
                                line: {
                                    dataLabels: {
                                        enabled: true
                                    },
                                    enableMouseTracking: false
                                }
                            },
                            series: [{
                                name: 'Gasolina',
                                data: data.gasolina
                            }, {
                                name: 'Diesel',
                                data: data.diesel
                            }]
                        });
                    })
                    .catch(function (error) {
                        console.error(error);
                    })
            }

            function crearComprasChart() {
                axios.get("/dashboard/getResumenCompras")
                    .then(({data}) => {

                        Highcharts.chart('compras-chart', {
                            chart: {
                                type: 'line'
                            },
                            title: {
                                text: 'Resumen Recepción de Inventario'
                            },
                            subtitle: {
                                text: ''
                            },
                            xAxis: {
                                categories: data.labels
                            },
                            yAxis: {
                                title: {
                                    text: 'Litros'
                                }
                            },
                            plotOptions: {
                                line: {
                                    dataLabels: {
                                        enabled: true
                                    },
                                    enableMouseTracking: false
                                }
                            },
                            series: [{
                                name: 'Gasolina',
                                data: data.gasolina
                            }, {
                                name: 'Diesel',
                                data: data.diesel
                            }]
                        });
                    })
                    .catch(function (error) {
                        console.error(error);
                    })

            }
        });
    </script>
@endpush
