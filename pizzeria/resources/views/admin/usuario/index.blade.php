@extends('layouts.admin')

@section('title', 'Usuarios')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Usuarios</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Listado de Usuarios</h6>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAgregarUsuario">
            Agregar nuevo
        </button>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tablaUsuarios" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Tipo</th>
                        <th>Activo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->usuario }}</td>
                            <td>{{ $usuario->tipoUsuario->tipousuario ?? 'Sin tipo' }}</td>
                            <td>
                                @if ($usuario->activo)
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge badge-secondary">Desactivado</span>
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEditarUsuario{{ $usuario->id }}">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalEliminarUsuario{{ $usuario->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="modalAgregarUsuario" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('usuario.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" name="usuario" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="contrasena">Contraseña</label>
                        <input type="text" name="contrasena" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="fktipousuario">Tipo de Usuario</label>
                        <select name="fktipousuario" class="form-control" required>
                            <option value="">Seleccione...</option>
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->tipousuario }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group form-check">
                        <input type="hidden" name="activo" value="0">
                        <input type="checkbox" name="activo" value="1" class="form-check-input" id="activoNuevo">
                        <label class="form-check-label" for="activoNuevo">Activo</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modales Editar -->
@foreach ($usuarios as $usuario)
<div class="modal fade" id="modalEditarUsuario{{ $usuario->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('usuario.update', $usuario->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="usuario{{ $usuario->id }}">Usuario</label>
                        <input type="text" name="usuario" class="form-control" value="{{ $usuario->usuario }}" required>
                    </div>
                    <div class="form-group">
                        <label for="contrasena{{ $usuario->id }}">Contraseña</label>
                        <input type="text" name="contrasena" class="form-control" value="{{ $usuario->contrasena }}" required>
                    </div>
                    <div class="form-group">
                        <label for="fktipousuario{{ $usuario->id }}">Tipo de Usuario</label>
                        <select name="fktipousuario" class="form-control" required>
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->id }}" {{ $usuario->fktipousuario == $tipo->id ? 'selected' : '' }}>
                                    {{ $tipo->tipousuario }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="activo" value="0">
                    <div class="form-group form-check">
                        <input type="checkbox" name="activo" value="1" class="form-check-input" id="activo{{ $usuario->id }}" {{ $usuario->activo ? 'checked' : '' }}>
                        <label class="form-check-label" for="activo{{ $usuario->id }}">Activo</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach

<!-- Modales Eliminar -->
@foreach ($usuarios as $usuario)
<div class="modal fade" id="modalEliminarUsuario{{ $usuario->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('usuario.destroy', $usuario->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar <strong>{{ $usuario->usuario }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach

@section('scripts')
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Aceptar'
    });
</script>
@endif
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#tablaUsuarios').DataTable({
            language: {
                search: "Buscar:",
                lengthMenu: "Mostrar _MENU_ registros",
                info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                infoEmpty: "Mostrando 0 a 0 de 0 registros",
                zeroRecords: "No se encontraron resultados",
                emptyTable: "No hay datos disponibles en la tabla",
                paginate: {
                    first: "Primero",
                    previous: "Anterior",
                    next: "Siguiente",
                    last: "Último"
                }
            }
        });
    });
</script>
@endpush
@endsection
