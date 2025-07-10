@extends('layouts.admin')

@section('title', 'Clientes')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Clientes</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Listado de Clientes</h6>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAgregarCliente">
            Agregar nuevo
        </button>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tablaClientes" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>Dirección</th>
                        <th>Celular 1</th>
                        <th>Celular 2</th>
                        <th>Sexo</th>
                        <th>Activo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->id }}</td>
                            <td>{{ $cliente->nombres }} {{ $cliente->appaterno }} {{ $cliente->apmaterno }}</td>
                            <td>{{ $cliente->direccion }}</td>
                            <td>{{ $cliente->celular1 }}</td>
                            <td>{{ $cliente->celular2 }}</td>
                            <td>{{ $cliente->sexo->sexo }}</td>
                            <td>
                                @if ($cliente->activo)
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge badge-secondary">Desactivado</span>
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEditarCliente{{ $cliente->id }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalEliminarCliente{{ $cliente->id }}">
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
<div class="modal fade" id="modalAgregarCliente" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('cliente.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Cliente</h5>
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
                        <input type="text" name="direccion" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="celular1">Celular 1</label>
                        <input type="text" name="celular1" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="celular2">Celular 2</label>
                        <input type="text" name="celular2" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="fksexo">Sexo</label>
                        <select name="fksexo" class="form-control" required>
                            <option value="">Seleccione...</option>
                            @foreach ($sexos as $sexo)
                                <option value="{{ $sexo->id }}">{{ $sexo->sexo }}</option>
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

<!-- Modales Editar y Eliminar -->
@foreach ($clientes as $cliente)
<!-- Modal Editar -->
<div class="modal fade" id="modalEditarCliente{{ $cliente->id }}" tabindex="-1" role="dialog">
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
                        <input type="text" name="direccion" class="form-control" value="{{ $cliente->direccion }}" required>
                    </div>
                    <div class="form-group">
                        <label for="celular1">Celular 1</label>
                        <input type="text" name="celular1" class="form-control" value="{{ $cliente->celular1 }}" required>
                    </div>
                    <div class="form-group">
                        <label for="celular2">Celular 2</label>
                        <input type="text" name="celular2" class="form-control" value="{{ $cliente->celular2 }}">
                    </div>
                    <div class="form-group">
                        <label for="fksexo">Sexo</label>
                        <select name="fksexo" class="form-control" required>
                            @foreach ($sexos as $sexo)
                                <option value="{{ $sexo->id }}" {{ $cliente->fksexo == $sexo->id ? 'selected' : '' }}>{{ $sexo->sexo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="activo" value="0">
                    <div class="form-group form-check">
                        <input type="checkbox" name="activo" value="1" class="form-check-input" id="activo{{ $cliente->id }}" {{ $cliente->activo ? 'checked' : '' }}>
                        <label class="form-check-label" for="activo{{ $cliente->id }}">Activo</label>
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

<!-- Modal Eliminar -->
<div class="modal fade" id="modalEliminarCliente{{ $cliente->id }}" tabindex="-1" role="dialog">
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
                    ¿Estás seguro de que deseas eliminar al cliente <strong>{{ $cliente->nombres }} {{ $cliente->appaterno }}</strong>?
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
