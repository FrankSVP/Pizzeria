@extends('layouts.admin')

@section('title', 'Clientes')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Clientes</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Listado de clientes</h6>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAgregar">
            Agregar nuevo
        </button>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tablaClientes" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombres</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td>{{ $cliente->nombres }}</td>
                        <td>{{ $cliente->appaterno }}</td>
                        <td>{{ $cliente->apmaterno }}</td>
                        <td>{{ $cliente->direccion }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEditar{{ $cliente->id }}">
                                <i class="fas fa-edit"></i>
                            </a>

                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalEliminar{{ $cliente->id }}">
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
<div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('cliente.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar cliente</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombres">Nombres</label>
                        <input type="text" name="nombres" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="appaterno">Apellido Paterno</label>
                        <input type="text" name="appaterno" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="apmaterno">Apellido Materno</label>
                        <input type="text" name="apmaterno" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="celular1">Teléfono móvil 1</label>
                        <input type="text" name="celular1" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="celular2">Teléfono móvil 2</label>
                        <input type="text" name="celular2" class="form-control">
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
@foreach ($clientes as $cliente)
<div class="modal fade" id="modalEditar{{ $cliente->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('cliente.update', $cliente->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombres">Nombres</label>
                        <input type="text" name="nombres" class="form-control" value="{{ $cliente->nombres }}" required>
                    </div>

                    <div class="form-group">
                        <label for="appaterno">Apellido Paterno</label>
                        <input type="text" name="appaterno" class="form-control" value="{{ $cliente->appaterno }}" required>
                    </div>

                    <div class="form-group">
                        <label for="apmaterno">Apellido Materno</label>
                        <input type="text" name="apmaterno" class="form-control" value="{{ $cliente->apmaterno }}" required>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" name="direccion" class="form-control" value="{{ $cliente->direccion }}">
                    </div>

                    <div class="form-group">
                        <label for="celular1">Teléfono móvil 1</label>
                        <input type="text" name="celular1" class="form-control" value="{{ $cliente->celular1 }}">
                    </div>

                    <div class="form-group">
                        <label for="celular2">Teléfono móvil 2</label>
                        <input type="text" name="celular2" class="form-control" value="{{ $cliente->celular2 }}">
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
@foreach ($clientes as $cliente)
<div class="modal fade" id="modalEliminar{{ $cliente->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('cliente.destroy', $cliente->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar <strong>{{ $cliente->nombres }}</strong>?
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
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Aceptar'
    });
</script>
@endif
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#tablaClientes').DataTable({
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