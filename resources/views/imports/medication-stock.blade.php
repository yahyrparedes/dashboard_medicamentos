@extends('layouts.app')

@section('page-title', 'Importar Stock')

@section('header-action-button')
    <button class="btn btn-primary btn-icon">
        <i class="bi bi-plus-circle"></i> Importar Stock
    </button>
@endsection

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="{{ route('import.pharmacy_store.import') }}" method="POST" enctype="multipart/form-data">
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
