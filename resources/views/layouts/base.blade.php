@php
$routeName = \Route::currentRouteName();
@endphp
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/d8cfbe84b9.js" crossorigin="anonymous"></script>
    <!-- CSS -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @yield('styles')
</head>

<body>
    <main id="container">
        <div id="sidebar">
            <h4><i class=""></i> MyParkPro</h4>
            <div>
                <img class="adminDp" src="{{ asset('img/userimg.jpg') }}" height="125px" alt="Tremenda foto del admin">
                <p>Administrador</p>
            </div>
            <ul id="options">
                <li class="option {{ $routeName == 'admin' ? 'active'  : ''}}">
                    <a href="{{ route('admin') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="option {{ $routeName == 'branches.index' ? 'active'  : ''}}">
                    <a href="{{ route('branches.index') }}">
                        <i class="fas fa-building"></i> Sucursales
                    </a>
                </li>
                <li class="option {{ $routeName == 'vehicles.index' ? 'active'  : ''}}">
                    <a href="{{ route('vehicles.index') }}">
                        <i class="fas fa-car"></i> Vehículos
                    </a>
                </li>
                <li class="option {{ $routeName == 'customers.index' ? 'active'  : ''}}">
                    <a href="{{ route('customers.index') }}">
                        <i class="fas fa-users"></i> Clientes
                    </a>
                </li>
                {{-- <li class="option">
                    <a href="./parking.php">
                        <i class="fas fa-ticket-alt"></i> Booking Actuales
                    </a>
                </li>
                <li class="option">
                    <a href="./slots.php">
                        <i class="fas fa-th"></i> Slots
                    </a>
                </li> --}}
                <li class="option {{ $routeName == 'admin.create' ? 'active'  : ''}}">
                    <a href="{{ route('admin.create') }}">
                        <i class="fas fa-user-lock"></i> Agregar nuevo administrador
                    </a>
                </li>
            </ul>
        </div>
        <div id="main-content">
            <section id="welcome">
                <ul>
                    <li class="welcome-item">Bienvenido, Administrador {{ Auth::user()->name }}
                    </li>
                    <li class="welcome-item">
                        <button id="logout" class="btn-sm">
                            <a href="{{ route('logout') }}">LOGOUT</a>
                        </button>
                    </li>
                </ul>
            </section>
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="my-0 alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ $error }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endforeach
            @endif
            @if (session('success'))
            <div class="my-0 alert alert-success alert-dismissible fade show" role="alert">
                <strong>Successful!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @yield('content')
        </div>
    </main>
    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>