@extends('layouts.base')
@section('title', 'Agregar administrador')
@section('styles')
<link href="{{ asset('css/signup.css') }}" rel="stylesheet">
@endsection
@section('content')
<section id="add-admin">
    <div>
        <div id="signupForm">
            <h2>AGREGAR ADMINISTRADOR</h2>
            <form action="{{ route('admin.store') }}" method="POST">
                @csrf
                <div>
                    <input type="text" name="name" placeholder="Nombre*">
                    <input type="text" name="last_name" placeholder="Apellido*" required>
                </div>
                <div>
                    <input type="text" name="username" placeholder="Usuario*" required>
                </div>
                <div>
                    <input id="password" type="password" name="password" placeholder="Contraseña*" required>
                    <span id="passwordErr" class="error"></span>
                </div>
                <div>
                    <input id="confPassword" type="password" name="password_confirmation" placeholder="Confirmar contraseña*" required>
                    <span id="confPassErr" class="error"></span>
                </div>
                <button id="signup-btn" type="submit" name="signup">AGREGAR</button>
            </form>
        </div>
    </div>
    <div>
    </div>
</section>
@endsection

@section('scripts')
<script src="{{ asset('js/admin_signup.js') }}"></script>
@endsection