@extends('layouts.app')

@section('page-title', 'Medicamentos')

@section('header-action-button')
    <button class="btn btn-primary btn-icon">
        <i class="bi bi-plus-circle"></i> Medicamentos
    </button>
@endsection

@section('content')

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
                        {{ $data->id }}
                    </td>
                    <td>
                         {{ $data->name }}
                    </td>
                    <td>
                        @if($data->is_active)
                            <form method="post" action="{{ route('medication.update', $data->id) }}">
                                @method('PATCH')
                                @csrf
                                <input type="text" class="form-control" name="active" value="0" hidden/>
                                <button type="submit" rel="tooltip" class="btn btn-danger">
                                    DESACTIVAR
                                </button>
                            </form>
                        @else
                            <form method="post" action="{{ route('medication.update', $data->id) }}">
                                @method('PATCH')
                                @csrf
                                <input type="text" class="form-control" name="active" value="1" hidden/>
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
