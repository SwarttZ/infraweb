@extends('backend.layout.master')

@section('title', 'dashboard')

@section('content')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://unpkg.com/tagin@2.0.2/dist/tagin.min.css">
@endpush
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Relatório Impressoras</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Relatórios</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
    <div class="grind-actions">
        <div class="col-sm-6">
            <form action="{{ route('admin.search.print') }}" method="POST">
                @csrf
                @foreach($printers as $print)
                <input name="id" value="{{ $print->id }}" hidden>
                @endforeach
                <div class="form-group">
                    <label>Filtrar (*)</label>
                    <select class="form-select" aria-label="Default select example">
                        <option name="filtro" selected>Selecionar ...</option>
                        <option value="igual">Igual</option>
                        <option value="contem">Diferente</option>
                        <option value="contem">Contém</option>
                        <option value="contem">Não Contém</option>
                    </select>
                </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group  custom-reports-form">
                <!-- checkbox pool fim-->
                <label>Colunas (*)</label>
                <input type="text" style="text-transform:uppercase;" name="tags_colunasdb" class="form-control tagin" id="colunas" value="hostname" />
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group  custom-reports-form">
                <label>Usuário(*)</label>
                <input name="name" class="form-control" placeholder="leandromoraes ..." />
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <button type="submit" class="btn btn-success bi-file-earmark-pdf" id="button-process"> Processar</button>
            </div>
        </div>
        </form>
    </div>
    <div class="container-computer-table">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>FABRICANTE</th>
                    <th>N°/SERIE</th>
                    <th>TIPO/CARTUCHO</th>
                    <th>MODELO/CARTUCHO</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                @foreach($printers as $print)
                <tr>
                    <td>{{ $print->fabricante }}</td>
                    <td>{{ $print->serial }}</td>
                    <td>{{ $print->tipoCartucho }}</td>
                    <td>{{ $print->modeloCartucho }}</td>
                    <td>
                        <div class="grind-actions-buttons">
                            <form action="{{ route('admin.print.printers') }}" method="POST">
                                @csrf
                                <input name="id" value="{{ $print->id }}" hidden>
                                <button type="submit" id="btn-custom" class="btn btn-success bi bi-eye-fill">
                                </button>
                            </form>

                            <form action="{{ route('admin.print.download') }}" method="POST">
                                @csrf
                                <input name="id" value="{{ $print->id }}" hidden>
                                <button type="submit" id="btn-custom" class="btn btn-warning bi bi-box-arrow-down">
                                </button>
                            </form>
                            <form action="{{ route('admin.print.delete') }}" method="POST">
                                @csrf
                                <input name="id" value="{{ $print->id }}" hidden>
                                <button type="submit" id="btn-custom" class="btn btn-danger bi bi-trash">
                                </button>
                            </form>
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @push('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://unpkg.com/tagin@2.0.2/dist/tagin.min.js"></script>
    <script>
        const tagin = new Tagin(document.querySelector('#colunas'), {
            separator: ' '
        })
    </script>
    @endpush
    @endsection