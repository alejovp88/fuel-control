@extends('layouts.app')

@section('pageTitle')
    Recepci&oacute;n de Inventario
@endSection

@section('content')
    <div class="row p-3">
        <div class="col-12 p-3">
            <h1>Recepci&oacute;n de Inventario</h1>
        </div>
    </div>
    <div class="row p-3">
        <div class="col-12">
            <form class="row g-3 needs-validation" novalidate action="{{ route('inventario.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label for="validationCustom05" class="form-label">Numero Factura</label>
                        <input type="text" class="form-control" id="nro_factura" name="nro_factura" required>
                        <div class="invalid-feedback">
                            Please provide a valid zip.
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="validationCustom05" class="form-label">Monto Factura</label>
                        <input type="text" class="form-control" id="monto_factura" name="monto_factura" required>
                        <div class="invalid-feedback">
                            Please provide a valid zip.
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="validationCustom05" class="form-label">Fecha Recepci&oacute;n</label>
                        <input type="text" class="form-control" id="fecha_recepcion" name="fecha_recepcion" required>
                        <div class="invalid-feedback">
                            Please provide a valid zip.
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="validationCustom05" class="form-label">Procedencia</label>
                        <input type="text" class="form-control" id="procedencia" name="procedencia" required>
                        <div class="invalid-feedback">
                            Please provide a valid zip.
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label for="validationCustom05" class="form-label">Nombre Chofer</label>
                        <input type="text" class="form-control" id="chofer" name="chofer" required>
                        <div class="invalid-feedback">
                            Please provide a valid zip.
                        </div>
                    </div>
                    <div class="col-md-8">
                        <label for="validationCustom05" class="form-label">Observaciones</label>
                        <input type="text" class="form-control" id="observaciones" name="observaciones" required>
                        <div class="invalid-feedback">
                            Please provide a valid zip.
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div>
                            <label style="font-weight: 700; font-size: 28px">Items</label>
                            <a class="btn btn-success ms-2" id="addItem">Agregar Item</a>
                        </div>
                        <table class="table" id="inventario_items_table">
                            <thead>
                                <tr>
                                    <th>Tipo Combustible</th>
                                    <th>Litros</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="form-select" name="tipo_combustible[]" required>
                                            <option selected disabled value="">Seleccione...</option>
                                            <option value="0">Gasolina</option>
                                            <option value="1">Diesel</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="litros[]" required>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6 mt-3">
                        <button class="btn btn-primary" type="submit">Registrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row p-3">
        <div class="col-12 col-md-12 col-lg-12">
            <h4>Inventario Recibido</h4>
            <table class="table" id="inventario-table">
                <thead>
                    <tr>
                        <th>Nro Factura</th>
                        <th>Fecha</th>
                        <th>Tipo Combustible</th>
                        <th>Litros</th>
                    </tr>
                </thead>
                <tbody>
                @if(empty($recepcion))
                    <tr>
                        <td colspan="4">No Hay Registros Disponibles</td>
                    </tr>
                @else
                    @foreach($recepcion as $row)
                        <tr>
                            <td>{{$row->nro_factura}}</td>
                            <td>{{$row->fecha_recepcion}}</td>
                            <td>{{$row->tipo_combustible}}</td>
                            <td>{{$row->litros}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#fecha_recepcion').daterangepicker({
                opens: 'left',
                singleDatePicker: true,
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
            });

            $('#addItem').on('click', function () {

                let newRowContent = `<tr>
                                        <td>
                                            <select class="form-select" name="tipo_combustible[]" required>
                                              <option selected disabled value="">Seleccione...</option>
                                              <option value="0">Gasolina</option>
                                              <option value="1">Diesel</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="litros[]" required>
                                        </td>
                                     </tr>`;

                $("#inventario_items_table tbody").append(newRowContent);
            });
        });
    </script>
@endpush
