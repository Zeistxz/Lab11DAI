@extends('layouts.base')
@section('title', 'Clientes')
@section('styles')
<link href="{{ asset('css/admin-options.css') }}" rel="stylesheet">
@endsection
@section('content')
@if($customers->count())
<section id="customer">
    <div id="head">
        <h4>Clientes </h4>
    </div>
    <div id="customer-results">
        <div>
            <button id="add-button" class="button btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addModal">Agregar Clientes <i class="fas fa-plus"></i></button>
        </div>
        <table class="table table-hover table-bordered">
            <thead>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Dirección</th>
                <th>Correo</th>
                <th>Celular</th>
                <th>Acciones</th>
            </thead>
            @foreach($customers as $customer)
            <tr>
                <td>
                    {{ $customer->dni }}
                </td>
                <td>
                    {{ $customer->name }}
                </td>
                <td>
                    {{ $customer->lastname }}
                </td>
                <td>
                    {{ $customer->address }}
                </td>
                <td>
                    {{ $customer->email }}
                </td>
                <td>
                    {{ $customer->phone }}
                </td>
                <td>
                    <button class="button edit-button " 
                        data-token="{{ csrf_token() }}"
                        data-link="{{ route('customers.update', $customer->id) }}" 
                        data-id="{{ $customer->id }}" 
                        data-dni="{{ $customer->dni }}" 
                        data-name="{{ $customer->name }}" 
                        data-lastname="{{ $customer->lastname }}"
                        data-address="{{ $customer->address }}"
                        data-email="{{ $customer->email }}"
                        data-phone="{{ $customer->phone }}">
                        Editar
                    </button>
                    <button class="button delete-button" data-bs-toggle="modal" data-bs-target="#deleteModal" 
                        data-link="{{ route('customers.destroy', $customer->id) }}" 
                        data-id="{{ $customer->id }}">
                        Eliminar
                    </button>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</section>
@else
<div class="container mt-4">
    <div id="noCustomers" class="alert alert-dark " role="alert">
        <h1 class="alert-heading">No hay clientes</h1>
        <p class="fw-light">Agregue nuevos clientes</p>
        <hr>
        <div id="addCustomerAlert" class="alert alert-success" role="alert">
            Click acá para <button id="add-button" class="button btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addModal">Agregar <i class="fas fa-plus"></i></button> un nuevo cliente.
        </div>
    </div>
</div>
@endif
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addCustomerForm" action="{{ route('customers.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="dni" class="form-label">DNI</label>
                        <input type="number" class="form-control" id="dni" name="dni" value="{{ old('dni') }}">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname') }}">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                    </div>                                        
                    <div class="mb-3">
                        <label for="phone" class="form-label">Celular</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                    </div>
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
                    Seguro que desea eliminar este cliente? <strong>Este proceso es irreversible.</strong>
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
<script src="{{ asset('js/admin_customer.js') }}"></script>
@endsection