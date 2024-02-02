@extends('layouts.app')

@section('page-title', 'Provincia')

@section('header-action-button')
    <button class="btn btn-primary btn-icon">
        <i class="bi bi-plus-circle"></i> Provincia
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
                <div class="dropdown ms-auto">
                    <a href="#" data-bs-toggle="dropdown"
                       class="btn btn-primary dropdown-toggle"
                       aria-haspopup="true" aria-expanded="false">Actions</a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="#" class="dropdown-item">Action</a>
                        <a href="#" class="dropdown-item">Another action</a>
                        <a href="#" class="dropdown-item">Something else here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table id="province" class="table table-custom table-lg">
            <thead>
            <tr>
                <th>
                    <input class="form-check-input select-all" type="checkbox" data-select-all-target="#invoices" id="defaultCheck1">
                </th>
                <th>#</th>
                <th>Nombre</th>
                <th>Status</th>
{{--                <th>Status</th>--}}
{{--                <th>Date</th>--}}
{{--                <th class="text-end">Action</th>--}}
            </tr>
            </thead>

            <tbody>
            @foreach($province as $data)
            <tr>
                <td>
                    <input class="form-check-input" type="checkbox">
                </td>
                <td>
                    <a href="{{ route('district.show', $data->id) }}"> {{ $data->id }}</a>
                </td>
                <td>
                    <a href="{{ route('district.show', $data->id) }}"> {{ $data->name }}</a>
                </td>
                <td>
                    @if($data->is_active)
                        <form method="post" action="{{ route('province.update', $data->id) }}">
                            @method('PATCH')
                            @csrf
                            <input type="text" class="form-control" name="active" value="0" hidden/>
                            <button type="submit" rel="tooltip" class="btn btn-danger">
                                DESACTIVAR
                            </button>
                        </form>
                    @else
                        <form method="post" action="{{ route('province.update', $data->id) }}">
                            @method('PATCH')
                            @csrf
                            <input type="text" class="form-control" name="active" value="1" hidden/>
                            <button type="submit" rel="tooltip" class="btn btn-success">
                                ACTIVAR
                            </button>
                        </form>
                    @endif
                </td>
{{--                <td class="text-end">--}}
{{--                    <div class="dropdown">--}}
{{--                        <a href="#" data-bs-toggle="dropdown"--}}
{{--                           class="btn btn-floating"--}}
{{--                           aria-haspopup="true" aria-expanded="false">--}}
{{--                            <i class="bi bi-three-dots"></i>--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-menu dropdown-menu-end">--}}
{{--                            <a href="#" class="dropdown-item">View Detail</a>--}}
{{--                            <a href="#" class="dropdown-item">Send</a>--}}
{{--                            <a href="#" class="dropdown-item">Download</a>--}}
{{--                            <a href="#" class="dropdown-item">Print</a>--}}
{{--                            <a href="#" class="dropdown-item text-danger">Delete</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </td>--}}
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $province->links('vendor.pagination.custom') }}


@endsection

@section('script')
    <!-- Examples -->
    <script src="{{ url("dist/js/examples/invoices.js") }}"></script>
@endsection
