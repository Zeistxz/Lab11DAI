<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500&display=swap" rel="stylesheet">
    <!-- Font-awesome -->
    <script src="https://kit.fontawesome.com/d8cfbe84b9.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- CSS -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <div>
                    <a href="#" class="nav-item nav-logo">MyParkPro</a>
            </div>
                
            <ul>
                <li><a href="#" class="nav-item">Home</a></li>
                <li><a href="#about" class="nav-item">About</a></li>
            </ul>
            <div>
                <a href="#" class="login nav-item" data-bs-toggle="modal" data-bs-target="#loginModal"><i class="fas fa-sign-in-alt" style="margin-right: 0.4rem;"></i>Login</a>
            </div>
        </nav>
    </header>

    
    <!-- Pestaña login model -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('authenticate') }}" method="POST">
        @csrf
          <div class="mb-3">
              <label for="username" class="form-label">Usuario</label>
              <input type="text" class="form-control" id="username" name="username">
          </div>
          <div class="mb-3">
              <label for="password" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="password" name="password">
              <div class="form-text">Nunca comparta la contraseña.</div>
          </div>
          <button type="submit" class="btn btn-success" name="submit">Login</button>
        </form>
      </div>
      <div class="modal-footer">
        <!-- Add anything here in the future -->
      </div>
    </div>
  </div>
</div>
    

    <section id="home">
        <div id="route-search-form">
            <h1>MyParkPro</h1>
            <p class="text-center">Enjoy the ####tiest page of parking lmao</p>
            <center>
                <button class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>  
            </center>
        </div>

    </section>
    <div id="block">
        <section id="about">
            <div>
                <h1>About Us</h1>
                <h4>Gestionando desde inicios de año</h4>
                <p>
                    Proyecto desarrollado al enfoque de un parqueo, registrando y eliminando registros (Sujeto a cambios) 
                </p>
            </div>
        </section>
        <footer>
        <p>
                        <i class="far fa-copyright"></i> {{ date('Y') }} - MyParkPro
                        </p>
        </footer>
    </div>
    
</div>
     <!-- Option 1: Bootstrap Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!-- External JS -->
    <script src="{{ asset('js/main.js') }}"></script>

    // pintar los errores
    @if ($errors->any())
        @php
            $err = ''
        @endphp
        @foreach ($errors->all() as $error)
            @php
                $err = $err . $error . '\n'
            @endphp
        @endforeach
        <script>alert('{{ $err }}')</script>
    @endif
    @if (session('error'))
        <script>alert("{{ session('error') }}")</script>
    @endif
</body>
</html>