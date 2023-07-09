@extends('layouts.base')
@section('title', 'Dashboard')
@section('styles')
<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
@endsection
@section('content')
<section id="dashboard">
    <div id="status">
        {{-- <div id="Parkeos" class="info-box status-item">
            <div class="heading">
                <h5>Parkeos</h5>
                <div class="info">
                    <i class="fas fa-ticket-alt"></i>
                </div>
            </div>
            <div class="info-content">
                <p>N° Total de vehículos estacionados</p>
                <p class="num" data-target="0">
                    999
                </p>
            </div>
            <a href="#">Mostrar <i class="fas fa-arrow-right"></i></a>
        </div> --}}
        <div id="Sucursales" class="info-box status-item">
            <div class="heading">
                <h5>Sucursales</h5>
                <div class="info">
                    <i class="fas fa-building"></i>
                </div>
            </div>
            <div class="info-content">
                <p>N° Total de sucursales</p>
                <p class="num" data-target="{{ $countBranches }}">
                    999
                </p>
            </div>
            <a href="{{ route('branches.index') }}">Mostrar <i class="fas fa-arrow-right"></i></a>
        </div>
        <div id="Vehículos" class="info-box status-item">
            <div class="heading">
                <h5>Vehículos</h5>
                <div class="info">
                    <i class="fas fa-car"></i>
                </div>
            </div>
            <div class="info-content">
                <p>N° Total de vehículos registrados</p>
                <p class="num" data-target="{{ $countVehicles }}">
                    999
                </p>
            </div>
            <a href="{{ route('vehicles.index') }}">Mostrar <i class="fas fa-arrow-right"></i></a>
        </div>
        {{-- <div id="Slots" class="info-box status-item">
            <div class="heading">
                <h5>Slots</h5>
                <div class="info">
                    <i class="fas fa-th"></i>
                </div>
            </div>
            <div class="info-content">
                <p>N° Total de Slots</p>
                <p class="num" data-target="0">
                    999
                </p>
            </div>
            <a href="#">Mostrar <i class="fas fa-arrow-right"></i></a>
        </div> --}}
        <div id="Clientes" class="info-box user-item">
            <div class="heading">
                <h5>Clientes</h5>
                <div class="info">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="info-content">
                <p>N° Total de clientes</p>
                <p class="num" data-target="{{ $countCustomers }}">
                    999
                </p>
            </div>
            <a href="{{ route('customers.index') }}">Mostrar <i class="fas fa-arrow-right"></i></a>
        </div>        
    </div>
    <!-- <h3>User</h3> -->
    <div id="user">
        <div id="Admin" class="info-box user-item">
            <div class="heading">
                <h5>Administradores</h5>
                <div class="info">
                    <i class="fas fa-user-lock"></i>
                </div>
            </div>
            <div class="info-content">
                <p>N° de Admins</p>
                <p class="num" data-target="{{ $countUsers }}">
                    999
                </p>
            </div>
            <a href="#">Mostrar <i class="fas fa-arrow-right"></i></a>
        </div>

        {{-- <div id="Profit" class="info-box user-item">
            <div class="heading">
                <h5>Tasa de ganancia</h5>
                <div class="info">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
            <div class="info-content">
                <p>Ganancias</p>
                <p class="num" data-target="0">
                    999
                </p>
            </div>
            <a href="#">Mostrar <i class="fas fa-arrow-right"></i></a>
        </div> --}}

    </div>
</section>
<footer>
    <p>
        <i class="far fa-copyright"></i> {{ date('Y') }} - MyParkPro
    </p>
</footer>
@endsection
@section('scripts')
<script src="{{ asset('js/admin_dashboard.js') }}"></script>
@endsection