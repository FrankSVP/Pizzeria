@extends('layouts.admin')

@section('title', 'Tipos de Producto')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Tipos de Productos</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Listado de Tipos de Producto</h6>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAgregarTipo">
            Agregar nuevo
        </button>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tablaTipos" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Activo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tipos as $tipo)
                        <tr>
                            <td>{{ $tipo->id }}</td>
                            <td>{{ $tipo->tipoproducto }}</td>
                            <td>
                                @if ($tipo->activo)
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge badge-secondary">Desactivado</span>
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEditarTipo{{ $tipo->id }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalEliminarTipo{{ $tipo->id }}">
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
<div class="modal fade" id="modalAgregarTipo" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('tipoproducto.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Tipo de Producto</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tipoproducto">Tipo</label>
                        <input type="text" name="tipoproducto" class="form-control" required>
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
@foreach ($tipos as $tipo)
<div class="modal fade" id="modalEditarTipo{{ $tipo->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('tipoproducto.update', $tipo->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Tipo de Producto</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tipoproducto{{ $tipo->id }}">Tipo</label>
                        <input type="text" name="tipoproducto" class="form-control" id="tipoproducto{{ $tipo->id }}" value="{{ $tipo->tipoproducto }}" required>
                    </div>
                    <input type="hidden" name="activo" value="0">
                    <div class="form-group form-check">
                        <input type="checkbox" name="activo" value="1" class="form-check-input" id="activo{{ $tipo->id }}" {{ $tipo->activo ? 'checked' : '' }}>
                        <label class="form-check-label" for="activo{{ $tipo->id }}">Activo</label>
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
@foreach ($tipos as $tipo)
<div class="modal fade" id="modalEliminarTipo{{ $tipo->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('tipoproducto.destroy', $tipo->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Tipo de Producto</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar <strong>{{ $tipo->tipoproducto }}</strong>?
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
        $('#tablaTipos').DataTable({
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
