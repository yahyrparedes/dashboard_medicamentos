@extends('layouts.app')

@section('page-title', 'Farmacias')

@section('header-action-button')
    <button class="btn btn-primary btn-icon">
        <i class="bi bi-plus-circle"></i> Farmacias
    </button>
@endsection

@section('content')


    <div class="table-responsive" style="overflow: hidden; outline: none;">
        <table class="table table-custom table-lg" id="orders">
            <thead>
            <tr>
                <th>
                    <input class="form-check-input select-all" type="checkbox" data-select-all-target="#orders"
                           id="defaultCheck1">
                </th>
                <th>#</th>
                <th>Tienda</th>
                <th>Medicamento</th>
                <th>Stock</th>
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
                        <a href="#">
                            {{ $data->code }}
                        </a>
                    </td>
                    <td>
                        {{ $data->description }}
                    </td>
                    <td>
                        {{ $data->name }}
                    </td>
                    <td>
                        {{ $data->stock }}
                    </td>
                    <td>
                        @if($data->is_active)
                            <form method="post" action="{{ route('pharmacy_store_stock.update', $data->id) }}">
                                @method('PATCH')
                                @csrf
                                <input type="text" class="form-control" name="is_active" value="0" hidden/>
                                <button type="submit" rel="tooltip" class="btn btn-danger">
                                    DESACTIVAR
                                </button>
                            </form>
                        @else
                            <form method="post" action="{{ route('pharmacy_store_stock.update', $data->id) }}">
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
