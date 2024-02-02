@extends('./layouts.auth')

@section('page-title', 'Login')

@section('content')

    <div class="form-wrapper">
        <div class="container">
            <div class="card">
                <div class="row g-0">
                    <div class="col">
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <div class="d-block d-lg-none text-center text-lg-start">
                                    <img width="120" src="{{ url('assets/images/logo.png') }}" alt="logo">
                                </div>
                                <div class="my-5 text-center text-lg-start">
                                    <h1 class="display-8">INICIAR SESIÓN</h1>
{{--                                    <p class="text-muted">Sign in to Vetra to continue</p>--}}
                                </div>

                                <!-- Session Status -->
                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                <form class="mb-5" method="POST" actixon="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="email" name="email" :value="old('email')"  class="form-control" placeholder="Ingresar Correo Electrónico" autofocus
                                               required  >
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" name="password" class="form-control" placeholder="Ingresar Contraseña"
                                               required  >
                                    </div>
                                    <div class="text-center text-lg-start">
{{--                                        <p class="small">Can't access your account? <a href="#">Reset your password now</a>.</p>--}}
                                        <button class="btn btn-primary">Iniciar Sesion</button>
                                    </div>
                                </form>
{{--                                <div class="social-links justify-content-center">--}}
{{--                                    <a href="#">--}}
{{--                                        <i class="ti-google bg-google"></i> Sign in with Google--}}
{{--                                    </a>--}}
{{--                                    <a href="#">--}}
{{--                                        <i class="ti-facebook bg-facebook"></i> Sign in with Facebook--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <p class="text-center d-block d-lg-none mt-5 mt-lg-0">--}}
{{--                                    Don't have an account? <a href="#">Sign up</a>.--}}
{{--                                </p>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col d-none d-lg-flex border-start align-items-center justify-content-between flex-column text-center">
                        <div class="logo">
                            <img width="120" src="{{ url('assets/images/logo.png') }}" alt="logo">
                        </div>
                        <div>
                            <h3 class="fw-bold">¡Bienvenido A Medicamentos!</h3>
                            <p class="lead my-5">Recuerda que este lugar es solo para personal autorizado.</p>
{{--                            <a href="#" class="btn btn-primary">Sign Up</a>--}}
                        </div>
                        <ul class="list-inline">
{{--                            <li class="list-inline-item">--}}
{{--                                <a href="#">Privacy Policy</a>--}}
{{--                            </li>--}}
{{--                            <li class="list-inline-item">--}}
{{--                                <a href="#">Terms & Conditions</a>--}}
{{--                            </li>--}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
