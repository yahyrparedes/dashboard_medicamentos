@extends('layouts.app')

@section('page-title', 'Importar Farmacias')

@section('header-action-button')
    <button class="btn btn-primary btn-icon">
        <i class="bi bi-plus-circle"></i> Departamentos
    </button>
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('import.pharmacy.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="file">Choose Excel File</label>
                    <input type="file" name="file" id="file" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Import</button>
            </form>
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

            </tbody>
        </table>
    </div>


@endsection

@section('script')
    <!-- Examples -->
    <script src="{{ url("dist/js/examples/invoices.js") }}"></script>
@endsection
