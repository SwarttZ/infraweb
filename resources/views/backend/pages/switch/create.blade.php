@extends('backend.layout.master')

@section('title', 'dashboard')

@section('content')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
@endpush
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cadastro</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Switch/Roteadores</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            @if (count($errors) > 0)
            <div class="alert alert-danger" style="text-align:center">
                <strong>Ooops!</strong> algo deu errado verifique todos os campos.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div><br />
            @endif
            @if(session('success'))
            <div class="alert alert-success" style="text-align:center">
                {{ session('success') }}
            </div>
            @endif
            <form action="{{ route('admin.store.switch') }}" method="POST">
                @csrf
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="nav-icon fa fa-server" aria-hidden="true" nav-icon></i> Switch/Roteadores </h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputStatus">Fabricante (*)</label>
                            <input name="fabricante" style="text-transform: uppercase" placeholder="Dell" type="text" id="ipAddress" class="form-control">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="inputStatus">N° Série (*)</label>
                            <input name="numeroSerie" style="text-transform: uppercase" placeholder="*A123456789*" type="text" id="ipAddress" class="form-control">
                        </div>
                        <hr>
                        <!--Switch-->
                        <label>Quantidade de portas (*)</label>
                        <li style="display: flex;">
                            <select name="qtdPortas" class="form-select" id="inputGroupSelect03Impressora">
                                <option selected>Escolha ...</option>
                                <option value="04">04</option>
                                <option value="08">08</option>
                                <option value="16">16</option>
                                <option value="24">24</option>
                                <option value="48">48</option>
                            </select>
                        </li>
                        <hr>

                        <!--Localizacao-->
                        <label>Localização (*)</label>
                        <li style="display: flex;">
                            <select name="localizacao" class="form-select" id="inputGroupSelect03Impressora">
                                <option selected>Escolha ...</option>
                                <option value="Rack/Principal">Rack/Principal</option>
                                <option value="Rack/TI">Rack/TI</option>
                                <option value="Rack/Atendimento">Rack/Atendimento</option>
                                <option value="Repetidor">Repetidor</option>
                                <option value="Outro">Outro</option>
                            </select>
                        </li>
                        <hr>
                        <div class="form-group">
                            <label for="inputDescription">Observações</label>
                            <textarea name="observacoes" id="inputDescription" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a href="#" class="btn btn-secondary">Cancelar</a>
                                <input type="submit" value="Salvar" class="btn btn-success float-right">
                            </div>
            </form>
        </div>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
</div>
@push('scripts')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://unpkg.com/tagin@2.0.2/dist/tagin.min.js"></script>
@endpush
@endsection