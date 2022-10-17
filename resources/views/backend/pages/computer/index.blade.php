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
                    <h1>Relatório computadores</h1>
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
            <form action="{{ route('admin.report.filter.computers') }}" method="GET">
                @csrf
                <div class="form-group">
                    <label>Filtrar (*)</label>
                    <select class="form-select" aria-label="Default select example">
                        <option name="filtro" selected="">Selecionar ...</option>
                        <option value="Igual">Igual</option>
                        <option value="Diferente">Diferente</option>
                        <option value="Contem">Contém</option>
                    </select>
                </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label>Usuário(*)</label>
                <input name="name" class="form-control custom-reports-form" placeholder="nome usuário ..." />
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
                    <th>HOSTNAME</th>
                    <th>ID/TEAMVIEWER</th>
                    <th>SETOR</th>
                    <th>NOME/USUÁRIO</th>
                    <th>IPV4/LOCAL</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                @foreach($computer as $computers)
                <tr>
                    <td>{{ $computers->hostname }}</td>
                    <td>{{ $computers->idteamviewer }}</td>
                    <td>{{ $computers->setor }}</td>
                    <td>{{ $computers->nomeUsuario }}</td>
                    <td>{{ $computers->ipv4 }}</td>
                    <td>
                        <div class="grind-actions-buttons">
                            <form action="{{ route('admin.report.computers', ['id' => $computers->id]) }}" method="POST" id="print" target="_blank">
                                @csrf
                                <button type="submit" id="btn-custom" class="btn btn-success bi bi-eye-fill">
                                </button>
                            </form>
                            <form action="{{ route('admin.update.computers', ['id' => $computers->id]) }}" method="GET" target="_blank">
                                @csrf
                                <button type="submit" id="btn-custom" class="btn btn-primary bi bi-pencil-square">
                                </button>
                            </form>
                            <form action="{{ route('admin.delete.computers', ['id' => $computers->id]) }}" onclick="return confirm('Tem certeza que deseja deletar este computador?')" method="GET">
                                @csrf
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
    <div class="container-paginator">
        {{ $computer->onEachSide(6)->links() }}
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