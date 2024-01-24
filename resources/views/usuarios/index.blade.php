@extends('layouts.app')

@section('pageTitle')
    Usuarios
@endSection

@section('content')
    <div class="row p-3">
        <div class="col-12 p-3">
            <h1>Usuarios</h1>
        </div>
        <div class="col-2 col-md-2 col-lg-2 col-xl-1 offset-9 offset-md-9 offset-lg-9 offset-xl-10">
            <a class="btn btn-primary" href="{{ route("usuarios.create") }}">Agregar</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <table class="table" id="rubros-table">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($usuarios as $row)
                    <tr>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->nombre }}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                <a class="btn btn-outline-primary" title="Ver" href="{{route('usuarios.show', ['usuario'=> $row->id])}}"><i class="far fa-eye"></i></a>
                            </div>
                            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                <a class="btn btn-outline-secondary" title="Editar" href="{{route('usuarios.edit', ['usuario'=> $row->id])}}"><i class="far fa-edit"></i></a>
                            </div>
                        </td>
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
            $('#rubros-table').dataTable({
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
            });
        });
    </script>
@endpush
