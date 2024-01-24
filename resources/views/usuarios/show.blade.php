@extends('layouts.app')

@section('pageTitle')
    Usuarios
@endSection

@section('content')
    <div class="row p-3">
        <div class="col-12">
            <h4 class="pt-3 pb-3">Detalle Usuario</h4>
            <form class="row g-3 needs-validation" novalidate>
                <div class="col-md-4">
                    <label class="form-label" style="font-weight: bolder">Nombre</label>
                    <br><label>{{ $usuario->name }}</label>
                </div>
                <div class="col-md-4">
                    <label class="form-label" style="font-weight: bolder">Email</label>
                    <br><label>{{ $usuario->email }}</label>
                </div>
                <div class="col-md-4">
                    <label class="form-label" style="font-weight: bolder">Rol</label>
                    <br><label>{{ $rol->nombre }}</label>
                </div>
                <div class="col-12">
                    <a class="btn btn-link" href="{{route('usuarios')}}">Volver</a>
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
