@extends('layouts.app')

@section('pageTitle')
    Rubros
@endSection

@section('content')
    <div class="row p-3">
        <h4 class="pt-3 pb-3">Editar Rubro</h4>
        <div class="col-12">
            <form class="row g-3 needs-validation" novalidate action="{{ route('rubros.update', ['rubro'=> $rubro->id]) }}" method="post">
                @csrf
                @method('put')
                <div class="col-md-3">
                    <label for="validationCustom01" class="form-label">Nombre</label>
                    <input type="text" class="form-control disabled" id="nombre" name="nombre" value="{{ $rubro->nombre }}" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">Estatus</label>
                    <select class="form-select disabled" id="active" name="active" required>
                        <option selected disabled value="">Seleccione...</option>
                        <option value="1" @if($rubro->active == 1) selected @endif>Activo</option>
                        <option value="0" @if($rubro->active == 0) selected @endif>Inactivo</option>
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid state.
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Guardar Cambios</button>
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
