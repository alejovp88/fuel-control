@extends('layouts.app')

@section('pageTitle')
    Rubros
@endSection

@section('content')
    <div class="row p-3">
        <h4 class="pt-3 pb-3">Visualizar Rubro</h4>
        <div class="col-12">
            <form class="row g-3 needs-validation" novalidate action="{{ route('control.store') }}" method="post">
                @csrf
                <div class="col-md-3">
                    <label class="form-label" style="font-weight: bolder">Nombre</label>
                    <br><label>{{ $rubro->nombre }}</label>
                </div>
                <div class="col-md-3">
                    <label class="form-label" style="font-weight: bolder">Estatus</label>
                    <br><label>{{ (($rubro->active == 1) ? "Activo" : "Inactivo") }}</label>
                </div>
                <div class="col-12">
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
