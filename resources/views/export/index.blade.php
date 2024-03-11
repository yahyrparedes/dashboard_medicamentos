@extends('layouts.app')

@section('page-title', 'Reporte de pacientes')


@section('content')
    <div class="row ">
        <div class="card widget">
            <div class="card-header m-2">
                <div class="row ">
                    <div class="col-8">
                        <h5 class="card-title">Cupones Ecommerce</h5>
                    </div>
                    <div class="col-4">
                        <form method="post" action="{{ route('orders.coupons.reports') }}">
                            @method('POST')
                            @csrf
                            <input type="text" id="name" name="name" value="all" hidden/>
                            <button class="text-muted btn btn-outline-dark  btn-icon">
                                <i class="bi bi-download"></i>
                                descargar reporte completo</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row g-3">
                @foreach($coupons as $data)
                    <div class="col-md-4">
                        <div class="card border-0">
                            <div class="card-body text-center">
                                <div class="display-6">
                                    <span class="avatar">
                                        <img src="{{ url('assets/images/coupon.webp') }}"
                                             class="rounded-circle" alt="image">
                                    </span>
                                </div>
                                <div class="display-5">
                                    <i class="bi bi-piggy-bank text-secondary"></i>
                                </div>
                                <h6 class="my-3">
{{--                                    <a href="{{ route('orders.coupons.detail', $data->name) }}">--}}
                                        {{$data->name}}
{{--</a>--}}
                                </h6>
                                <form method="post" action="{{ route('orders.coupons.reports') }}">
                                    @method('POST')
                                    @csrf
                                    <input type="text" id="name" name="name" value="{{$data->name}}" hidden/>
                                    <button class="btn btn-outline-primary btn-icon">
                                        <i class="bi bi-download"></i>
                                        descargar reporte completo</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('script')
    <!-- Examples -->
    <script src="{{ url("dist/js/examples/chat.js") }}"></script>
@endsection
