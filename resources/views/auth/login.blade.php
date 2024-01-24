@extends('layouts.auth')

@section('content')
    <h3 class="h3" style="color: white">Control de Combustible</h3>
    <form method="POST" action="/login" class="p-0">
        @csrf
        <div class="mb-3">
            <label class="form-label" style="color: white">Usuario</label>
            <input type="email" name="email" class="form-control" placeholder="Email" required>
            <div class="invalid-feedback">
                Please provide a valid e-mail address.
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label" style="color: white">Clave</label>
            <input type="password" name="password" class="form-control" placeholder="Password"
                   required>
            <div class="invalid-feedback">
                Please provide a valid password.
            </div>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
            <button type="submit" class="btn-primary mb-2 btn-sm">
                Iniciar Sessi&oacute;n
            </button>
            {{--<a href="/forgot-password">Olvid&oacute; su Contrase&ntilde;a?</a>--}}
        </div>
    </form>
@endsection
