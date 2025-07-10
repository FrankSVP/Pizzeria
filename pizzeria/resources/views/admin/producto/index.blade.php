@extends('layouts.admin')

@section('title', 'Productos')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Productos</h1>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Listado de Productos</h6>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAgregarProducto">
            Agregar nuevo
        </button>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="tablaProductos" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Tipo</th>
                        <th>Activo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->id }}</td>
                            <td>{{ $producto->nombreproducto }}</td>
                            <td>{{ $producto->descripcionproducto }}</td>
                            <td>{{ $producto->precioproducto }}</td>
                            <td>{{ $producto->stock }}</td>
                            <td>{{ $producto->tipoProducto->tipoproducto }}</td>
                            <td>
                                @if ($producto->activo)
                                    <span class="badge badge-success">Activo</span>
                                @else
                                    <span class="badge badge-secondary">Desactivado</span>
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEditarProducto{{ $producto->id }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalEliminarProducto{{ $producto->id }}">
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
<div class="modal fade" id="modalAgregarProducto" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('producto.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombreproducto">Nombre</label>
                        <input type="text" name="nombreproducto" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcionproducto">Descripción</label>
                        <input type="text" name="descripcionproducto" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="precioproducto">Precio</label>
                        <input type="number" name="precioproducto" class="form-control" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" name="stock" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="fktipoproducto">Tipo de Producto</label>
                        <select name="fktipoproducto" class="form-control" required>
                            <option value="">Seleccione...</option>
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->tipoproducto }}</option>
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
{{-- Modal Editar Producto --}}
<div class="modal fade" id="modalEditarProducto{{ $producto->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('producto.update', $producto->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombreproducto{{ $producto->id }}">Nombre</label>
                        <input type="text" name="nombreproducto" class="form-control" value="{{ $producto->nombreproducto }}" required>
                    </div>
                    <div class="form-group">
                        <label for="descripcionproducto{{ $producto->id }}">Descripción</label>
                        <input type="text" name="descripcionproducto" class="form-control" value="{{ $producto->descripcionproducto }}" required>
                    </div>
                    <div class="form-group">
                        <label for="precioproducto{{ $producto->id }}">Precio</label>
                        <input type="number" step="0.01" name="precioproducto" class="form-control" value="{{ $producto->precioproducto }}" required>
                    </div>
                    <div class="form-group">
                        <label for="stock{{ $producto->id }}">Stock</label>
                        <input type="number" name="stock" class="form-control" value="{{ $producto->stock }}" required>
                    </div>
                    <div class="form-group">
                        <label for="fktipoproducto{{ $producto->id }}">Tipo de Producto</label>
                        <select name="fktipoproducto" class="form-control" required>
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->id }}" {{ $producto->fktipoproducto == $tipo->id ? 'selected' : '' }}>{{ $tipo->tipoproducto }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="activo" value="0">
                    <div class="form-group form-check">
                        <input type="checkbox" name="activo" value="1" class="form-check-input" id="activo{{ $producto->id }}" {{ $producto->activo ? 'checked' : '' }}>
                        <label class="form-check-label" for="activo{{ $producto->id }}">Activo</label>
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

{{-- Modal Eliminar Producto --}}
<div class="modal fade" id="modalEliminarProducto{{ $producto->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('producto.destroy', $producto->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar el producto <strong>{{ $producto->nombreproducto }}</strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </form>
    </div>
</div>


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
        $('#tablaProductos').DataTable({
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
