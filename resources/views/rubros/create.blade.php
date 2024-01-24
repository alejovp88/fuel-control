@extends('layouts.app')

@section('pageTitle')
    Rubros
@endSection

@section('content')
    <div class="row p-3">
        <div class="col-12">
            <h4 class="pt-3 pb-3">Crear Rubro</h4>
            <form class="row g-3 needs-validation" novalidate action="{{ route('rubros.store') }}" method="post">
                @csrf
                <div class="col-md-3">
                    <label for="validationCustom01" class="form-label">Nombre</label>
                    <input type="text" class="form-control disabled" id="nombre" name="nombre" value="" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">Estatus</label>
                    <select class="form-select disabled" id="active" name="active" required>
                        <option selected disabled value="">Seleccione...</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid state.
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                    <a class="btn btn-link" href="{{route('rubros')}}">Volver</a>
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
