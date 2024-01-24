@extends('layouts.app')

@section('pageTitle')
    Usuarios
@endSection

@section('content')
    <div class="row p-3">
        <div class="col-12">
            <h4 class="pt-3 pb-3">Crear Usuario</h4>
            <form class="row g-3 needs-validation" novalidate action="{{ route('usuarios.store') }}" method="post">
                @csrf
                <div class="col-md-3">
                    <label for="validationCustom01" class="form-label">Nombre</label>
                    <input type="text" class="form-control disabled" id="name" name="name" value="" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="validationCustom01" class="form-label">Email</label>
                    <input type="text" class="form-control disabled" id="email" name="email" value="" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="validationCustom01" class="form-label">Clave</label>
                    <input type="password" class="form-control disabled" id="password" name="password" value="" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="validationCustom04" class="form-label">Rol</label>
                    <select class="form-select disabled" id="rol_id" name="rol_id" required>
                        <option selected disabled value="">Seleccione...</option>
                        @foreach($roles as $row)
                        <option value="{{ $row->id }}">{{ $row->nombre }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid state.
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Guardar</button>
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
