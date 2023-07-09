@extends('layouts.base')
@section('title', 'Vehículos')
@section('styles')
<link href="{{ asset('css/admin-options.css') }}" rel="stylesheet">
@endsection
@section('content')
@if($vehicles->count())
<section id="route">
    <div id="head">
        <h4>Vehículos agregados</h4>
    </div>
    <div id="route-results">
        <div>
            <button id="add-button" class="button btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addModal">Agregar nuevo vehículo <i class="fas fa-plus"></i></button>
        </div>
        <table class="table table-hover table-bordered">
            <thead>
                <th>Dueño</th>
                <th>Placa</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Color</th>
                <th>descripción</th>
                <th>Acciones</th>
            </thead>
            @foreach($vehicles as $vehicle)
            <tr>
                <td>
                    {{ $vehicle->customer->name }} {{ $vehicle->customer->lastname }}
                </td>
                <td>
                    {{ $vehicle->plate }}
                </td>
                <td>
                    {{ $vehicle->brand }}
                </td>
                <td>
                    {{ $vehicle->model }}
                </td>
                <td>
                    {{ $vehicle->year }}
                </td>
                <td>
                    {{ $vehicle->color }}
                </td>
                <td>
                    {{ $vehicle->description }}
                </td>
                <td>
                <button class="button edit-button " 
                        data-token="{{ csrf_token() }}"
                        data-link="{{ route('vehicles.update', $vehicle->id) }}" 
                        data-id="{{ $vehicle->id }}" 
                        data-customer_id="{{ $vehicle->customer_id }}" 
                        data-customers="{{ $customers->toJson() }}" 
                        data-plate="{{ $vehicle->plate }}" 
                        data-brand="{{ $vehicle->brand }}"
                        data-model="{{ $vehicle->model }}"
                        data-year="{{ $vehicle->year }}"
                        data-color="{{ $vehicle->color }}"
                        data-description="{{ $vehicle->description }}">
                        Editar
                    </button>
                    <button class="button delete-button" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $vehicle->id }}" data-link="{{ route('vehicles.destroy', $vehicle->id) }}">Eliminar</button>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</section>
@else
<div class="container mt-4">
    <div id="noRoutes" class="alert alert-dark " role="alert">
        <h1 class="alert-heading">No se encontraron vehículos</h1>
        <p class="fw-light">Agregue nuevos vehículos!</p>
        <hr>
        <div id="addRouteAlert" class="alert alert-success" role="alert">
            Click aquí <button id="add-button" class="button btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addModal">Agregar <i class="fas fa-plus"></i></button> para agregar un nuevo vehículo
        </div>
    </div>
</div>
@endif
<!-- Add Route Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar vehiculo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addRouteForm" action="{{ route('vehicles.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="customer_id" class="form-label">Cliente</label>
                        <select class="form-control" id="customer_id" name="customer_id" required>
                            <option value="" selected disabled>Seleccione un cliente</option>
                            @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->name }} {{ $customer->lastname }}</option>
                            @endforeach
                        </select>
                        <span id="error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="plate" class="form-label">Placa</label>
                        <input type="text" class="form-control" id="plate" name="plate" placeholder="" value="{{ old('plate') }}" required>
                        <span id="error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="brand" class="form-label">Marca</label>
                        <input type="text" class="form-control" id="brand" name="brand" placeholder="" value="{{ old('brand') }}" required>
                        <span id="error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="model" class="form-label">Modelo</label>
                        <input type="text" class="form-control" id="model" name="model" placeholder="" value="{{ old('model') }}" required>
                        <span id="error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="year" class="form-label">Año</label>
                        <input type="number" class="form-control" id="year" name="year" placeholder="" value="{{ old('year') }}" required>
                        <span id="error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="text" class="form-control" id="color" name="color" placeholder="" value="{{ old('color') }}" required>
                        <span id="error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="" value="{{ old('description') }}" required>
                        <span id="error"></span>
                    </div>
                    <input type="hidden" id="busJson" name="busJson" value=''>
                    <!-- <div class="mb-3">
                        <label for="sucname" class="form-label">Sucursal</label>
                        
                        <div class="searchBus">
                            <input type="text" class="form-control  sucnameInput" id="sucname" name="sucname" required>
                            <div class="sugg">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="stepCost" class="form-label">Costo</label>
                        <input type="number" class="form-control" id="stepCost" name="stepCost" required>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Fecha de Ingreso</label>
                        <input type="date" name="dep_date" id="date" min="" value="" required>
                    </div> -->
                    <button type="submit" class="btn btn-success" name="submit">Aceptar</button>
                </form>
            </div>
            <div class="modal-footer">
                <!-- Add Anything -->
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-circle"></i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h2 class="text-center pb-4">
                    Seguro?
                </h2>
                <p>
                    Seguro que desea eliminar este vehículo? <strong>Esta acción es irreversible.</strong>
                </p>
                <!-- Needed to pass id -->
                <form action="" id="delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <input id="delete-id" type="hidden" name="id">
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="delete-form" name="delete" class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/admin_routes.js') }}"></script>
@endsection