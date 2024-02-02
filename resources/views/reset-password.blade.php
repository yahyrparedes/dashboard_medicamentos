@extends('layouts.auth')

@section('page-title', 'Reset Password')

@section('content')

    <div class="form-wrapper">
        <div class="container">
            <div class="card">
                <div class="row g-0">
                    <div class="col">
                        <div class="row align-items-center">
                            <div class="col-md-10 offset-md-1">
                                <div class="d-block d-lg-none text-center text-lg-start">
                                    <img width="120" src="{{ url('assets/images/logo.svg') }}" alt="logo">
                                </div>
                                <div class="my-5 text-center text-lg-start">
                                    <h1 class="display-8 mb-3">Reset Password</h1>
                                    <p class="text-muted">Type and send the email address to reset your password.</p>
                                </div>
                                <form>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" placeholder="Enter email" autofocus
                                               required>
                                    </div>
                                    <div class="text-center text-lg-start">
                                        <button class="btn btn-primary mb-4">Send</button>
                                    </div>
                                </form>
                                <p class="text-center d-block d-lg-none mt-4 mt-lg-0">
                                    You can now <a href="{{ route('login') }}">sign in</a> or <a href="#">create an
                                        account</a>.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col d-none d-lg-flex border-start align-items-center justify-content-between flex-column text-center">
                        <div class="logo">
                            <img width="120" src="{{ url('assets/images/logo.svg') }}" alt="logo">
                        </div>
                        <div>
                            <h3 class="fw-bold mb-5">Do a different action</h3>
                            <div class="text-center">
                                You can now <a class="btn btn-primary btn-sm" href="#">sign in</a> or
                                <a class="btn btn-primary btn-sm" href="#">create an account</a>.
                            </div>
                        </div>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <a href="#">Privacy Policy</a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#">Terms & Conditions</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
