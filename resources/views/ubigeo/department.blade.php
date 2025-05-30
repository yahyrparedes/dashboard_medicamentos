@extends('layouts.app')

@section('page-title', 'Ubigeo Perú')

@section('header-action-button')
    <button class="btn btn-primary btn-icon">
        <i class="bi bi-plus-circle"></i> Departamentos
    </button>
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="d-md-flex">
                <div class="d-md-flex gap-4 align-items-center">
{{--                    <form class="mb-3 mb-md-0">--}}
{{--                        <div class="row g-3">--}}
{{--                            <div class="col-md-3">--}}
{{--                                <select class="form-select">--}}
{{--                                    <option>Sort by</option>--}}
{{--                                    <option value="desc">Desc</option>--}}
{{--                                    <option value="asc">Asc</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-3">--}}
{{--                                <select class="form-select">--}}
{{--                                    <option value="10">10</option>--}}
{{--                                    <option value="20">20</option>--}}
{{--                                    <option value="30">30</option>--}}
{{--                                    <option value="40">40</option>--}}
{{--                                    <option value="50">50</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <div class="input-group">--}}
{{--                                    <input type="text" class="form-control" placeholder="Search">--}}
{{--                                    <button class="btn btn-outline-light" type="button">--}}
{{--                                        <i class="bi bi-search"></i>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
                    <form class="mb-3 mb-md-0" method="GET" action="{{ route('department.index') }}">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <select class="form-select" name="sort">
                                    <option value="">Ordenar por</option>
                                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Desc</option>
                                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Asc</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" name="per_page">
                                    @foreach([10,20,30,40,50] as $n)
                                        <option value="{{ $n }}" {{ request('per_page', 50) == $n ? 'selected' : '' }}>{{ $n }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Buscar" value="{{ request('search') }}">
                                    <button class="btn btn-outline-light" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table id="invoices" class="table table-custom table-lg">
            <thead>
            <tr>
                <th>
                    <input class="form-check-input select-all" type="checkbox" data-select-all-target="#invoices"
                           id="defaultCheck1">
                </th>
                <th>#</th>
                <th>Nombre</th>
                <th>Status</th>
                {{--                <th class="text-end">Action</th>--}}
            </tr>
            </thead>
            <tbody>
            @foreach($department as $data)
                <tr>
                    <td>
                        <input class="form-check-input" type="checkbox">
                    </td>
                    <td>
                        <a href="{{ route('province.show', $data->id) }}">{{ $data->id }}</a>
                    </td>
                    <td>
                        <a href="{{ route('province.show', $data->id) }}"> {{ $data->name }}</a>
                    </td>
                    <td>
                        @if($data->is_active)
                            <form method="post" action="{{ route('department.update', $data->id) }}">
                                @method('PATCH')
                                @csrf
                                <input type="text" class="form-control" name="is_active" value="0" hidden/>
                                <button type="submit" rel="tooltip" class="btn btn-danger">
                                    DESACTIVAR
                                </button>
                            </form>
                        @else
                            <form method="post" action="{{ route('department.update', $data->id) }}">
                                @method('PATCH')
                                @csrf
                                <input type="text" class="form-control" name="is_active" value="1" hidden/>
                                <button type="submit" rel="tooltip" class="btn btn-success">
                                    ACTIVAR
                                </button>
                            </form>
                        @endif
                    </td>
                    {{--                <td><a class="btn btn-primary" type="button"--}}
                    {{--                       href="{{ route('province.index', $data->id_state) }}">--}}
                    {{--                        Provincias--}}
                    {{--                    </a></td>--}}
                    {{--                <td class="text-end">--}}
                    {{--                    <div class="dropdown">--}}
                    {{--                        <a href="#" data-bs-toggle="dropdown"--}}
                    {{--                           class="btn btn-floating"--}}
                    {{--                           aria-haspopup="true" aria-expanded="false">--}}
                    {{--                            <i class="bi bi-three-dots"></i>--}}
                    {{--                        </a>--}}
                    {{--                        <div class="dropdown-menu dropdown-menu-end">--}}
                    {{--                            <a href="{{ route('province.index', $data->id_state) }}" class="dropdown-item">Ver Provincias</a>--}}
                    {{--                            <a href="#" class="dropdown-item">Send</a>--}}
                    {{--                            <a href="#" class="dropdown-item">Download</a>--}}
                    {{--                            <a href="#" class="dropdown-item">Print</a>--}}
                    {{--                            <a href="#" class="dropdown-item text-danger">Delete</a> --}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                </td>--}}
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
