@extends('layouts.app')

@section('page-title', 'Farmacias')

@section('header-action-button')
    <button class="btn btn-primary btn-icon">
        <i class="bi bi-plus-circle"></i> Farmacias
    </button>
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="d-md-flex">
                <div class="d-md-flex gap-4 align-items-center">
                    <form class="mb-3 mb-md-0">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <select class="form-select">
                                    <option>Sort by</option>
                                    <option value="desc">Desc</option>
                                    <option value="asc">Asc</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select">
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <button class="btn btn-outline-light" type="button">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{--                <div class="dropdown ms-auto">--}}
                {{--                    <a href="#" data-bs-toggle="dropdown"--}}
                {{--                       class="btn btn-primary dropdown-toggle"--}}
                {{--                       aria-haspopup="true" aria-expanded="false">Actions</a>--}}
                {{--                    <div class="dropdown-menu dropdown-menu-end">--}}
                {{--                        <a href="#" class="dropdown-item">Action</a>--}}
                {{--                        <a href="#" class="dropdown-item">Another action</a>--}}
                {{--                        <a href="#" class="dropdown-item">Something else here</a>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
            </div>
        </div>
    </div>
    <div class="table-responsive" style="overflow: hidden; outline: none;">
        <table class="table table-custom table-lg" id="orders">
            <thead>
            <tr>
                <th>
                    <input class="form-check-input select-all" type="checkbox" data-select-all-target="#orders"
                           id="defaultCheck1">
                </th>
                <th>#</th>
                <th>Nombre / Dirección</th>
                <th></th>
                <th>Farmacia/Formato</th>
                <th>Departamento</th>
                <th>Provincia</th>
                <th>Distrito</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($department as $data)
                <tr>
                    <td>
                        <input class="form-check-input" type="checkbox">
                    </td>
                    <td>
                        <a href="{{ route('pharmacy_store_stock.show', $data->id) }}">
                            {{ $data->id }}
                        </a>
                    </td>
                    <td colspan="2">
                       <a href="#">{{ $data->description }} </a><br/>
                      <p style="font-size: 12px; white-space:pre-wrap; word-wrap:break-word">{{ $data->address}} </p>
                    </td>
                    <td>
                        {{ $data->pharmacy_name }} <br/>
                        ({{ $data->format}})
                    </td>
                    <td>
                        {{ $data->department_name }}
                    </td>
                    <td>
                        {{ $data->province_name  }}
                    </td>
                    <td>
                        {{ $data->district_name  }}
                    </td>
                    <td>
                        @if($data->is_active)
                            <form method="post" action="{{ route('pharmacy_store.update', $data->id) }}">
                                @method('PATCH')
                                @csrf
                                <input type="text" class="form-control" name="is_active" value="0" hidden/>
                                <button type="submit" rel="tooltip" class="btn btn-danger">
                                    DESACTIVAR
                                </button>
                            </form>
                        @else
                            <form method="post" action="{{ route('pharmacy_store.update', $data->id) }}">
                                @method('PATCH')
                                @csrf
                                <input type="text" class="form-control" name="is_active" value="1" hidden/>
                                <button type="submit" rel="tooltip" class="btn btn-success">
                                    ACTIVAR
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>


    {{ $department->links('vendor.pagination.custom') }}

@endsection

@section('script')
    <!-- Examples -->
    <script src="{{ url("dist/js/examples/invoices.js") }}"></script>
@endsection
