@extends('layouts.base')
@section('title', 'Sucursales')
@section('styles')
<link href="{{ asset('css/admin-options.css') }}" rel="stylesheet">
@endsection
@section('content')
@if($branches->count())
<section id="bus">
    <div id="head">
        <h4>Sucursales Actuales</h4>
    </div>
    <div id="bus-results">
        <div>
            <button id="add-button" class="button btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addModal">Agregar nueva sucursal <i class="fas fa-plus"></i></button>
        </div>

        <table class="table table-hover table-bordered">
            <thead>
                <th>Sucursal</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Encargado</th>
                <th>Acciones</th>
            </thead>
            @foreach($branches as $branch)
            <tr>
                <td>
                    {{ $branch->name }}
                </td>
                <td>
                    {{ $branch->address }}
                </td>
                <td>
                    {{ $branch->phone }}
                </td>
                <td>
                    {{ $branch->email }}
                </td>
                <td>
                    {{ $branch->manager }}
                </td>
                <td>
                    <button class="button edit-button " 
                        data-token="{{ csrf_token() }}" 
                        data-link="{{ route('branches.update', $branch->id) }}" 
                        data-id="{{ $branch->id }}" 
                        data-name="{{ $branch->name }}" 
                        data-address="{{ $branch->address }}" 
                        data-phone="{{ $branch->phone }}" 
                        data-email="{{ $branch->email }}" 
                        data-manager="{{ $branch->manager }}">
                        Editar
                    </button>
                    <button class="button delete-button" data-bs-toggle="modal" data-bs-target="#deleteModal" 
                        data-link="{{ route('branches.destroy', $branch->id) }}" 
                        data-id="{{ $branch->id }}">
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
    <div id="nobranches" class="alert alert-dark " role="alert">
        <h1 class="alert-heading">No hay sucursales</h1>
        <p class="fw-light">Agregue una sucursal.</p>
        <hr>
        <div id="addbranchAlert" class="alert alert-success" role="alert">
            Click para <button id="add-button" class="button btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#addModal">Agregar <i class="fas fa-plus"></i></button> una nueva sucursal!
        </div>
    </div>
</div>
@endif
<!-- Agregar Suc Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar sucursal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addBusForm" action="{{ route('branches.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre de sucursal</label><br>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        <span id="error" class="error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Dirección</label><br>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                        <span id="error" class="error"></span>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Teléfono</label><br>
                        <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
                        <span id="error" class="error"></span>
                    </div>   
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo</label><br>
                        <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        <span id="error" class="error"></span>
                    </div>   
                    <div class="mb-3">
                        <label for="manager" class="form-label">Encargado</label><br>
                        <input type="text" class="form-control" id="manager" name="manager" value="{{ old('manager') }}" required>
                        <span id="error" class="error"></span>
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
                    Seguro que desea borrar esta sucursal? <strong>Este proceso es irreversible.</strong>
                </p>
                <!-- Needed to pass id -->
                <form action="" id="delete-form" method="POST">
                    @csrf
                    @method('delete')
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
<script src="{{ asset('js/admin_bus.js') }}"></script>
@endsection