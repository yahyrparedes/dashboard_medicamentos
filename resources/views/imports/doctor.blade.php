@extends('layouts.app')

@section('page-title', 'Importar Farmacias')

@section('header-action-button')
    <button class="btn btn-primary btn-icon">
        <i class="bi bi-plus-circle"></i> Importar Doctor
    </button>
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('import.doctor.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="file" id="upload_error">Selecione su archivo </label>
                    <input type="file" maxlength="1000" required name="file" id="file"
                           accept="text/csv, .xls, .xlsx"
                           class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Import</button>
            </form>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ url("dist/js/upload.js") }}"></script>
@endsection
