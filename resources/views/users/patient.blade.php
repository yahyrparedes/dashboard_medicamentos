@extends('layouts.app')

@section('page-title', 'Pacientes')

@section('header-action-button')
    <button class="btn btn-primary btn-icon">
        <i class="bi bi-plus-circle"></i> Pacientes
    </button>
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="d-md-flex">
                <div class="d-md-flex gap-4 align-items-center">
                    <form class="mb-3 mb-md-0" method="GET" action="{{ route('patients.index') }}">
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
                <th>Apellido</th>
                <th>Correo</th>
                <th>Estado</th>
            </tr>
            </thead>
            <tbody>
            @foreach($patients as $data)
                <tr>
                    <td>
                        <input class="form-check-input" type="checkbox">
                    </td>
                    <td>
                        {{ $data->id }}
                    </td>
                    <td>
                         {{ $data->name }}
                    </td>
                    <td>
                        {{ $data->last_name }}
                    </td>
                    <td>
                        {{ $data->email }}
                    </td>
                    <td>
                        @if($data->is_active)
                            <form method="post" action="{{ route('patients.update', $data->id) }}">
                                @method('PATCH')
                                @csrf
                                <input type="text" class="form-control" name="active" value="0" hidden/>
                                <button type="submit" rel="tooltip" class="btn btn-danger">
                                    DESACTIVAR
                                </button>
                            </form>
                        @else
                            <form method="post" action="{{ route('patients.update', $data->id) }}">
                                @method('PATCH')
                                @csrf
                                <input type="text" class="form-control" name="active" value="1" hidden/>
                                <button type="submit" rel="tooltip" class="btn btn-success">
                                    ACTIVAR
                                </button>
                            </form>
                        @endif
                    </td>
                    <td>
                        <form method="post" action="{{ route('patients.reports',  $data->id)}}">
                            @method('POST')
                            @csrf
                            <input type="text" id="id" name="id" value="all" hidden/>
                            <button class="text-muted btn btn-outline-dark  btn-icon">
                                <i class="bi bi-download"></i> Descargar</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>


    {{ $patients->links('vendor.pagination.custom') }}

@endsection

@section('script')
    <!-- Examples -->
    <script src="{{ url("dist/js/examples/invoices.js") }}"></script>
@endsection
