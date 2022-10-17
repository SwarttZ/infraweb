@extends('backend.layout.master')

@section('title', 'dashboard')

@section('content')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/tagin@2.0.2/dist/tagin.min.css">
@endpush
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Servidores</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <a href="{{ route('admin.show.all.computers') }}"><button class="btn btn-primary">Voltar</button></a>
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title"><i class="nav-icon fa fa-tv" aria-hidden="true" nav-icon></i> Computadores </h3>
        </div><br />
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
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.store.computer') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Hostname (*)</label>
                            @foreach($computer as $computers)
                            <input name="hostname" type="text" class="form-control custom-form" value="{{ $computers->hostname }}" placeholder="desktop-pc01 ...">
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Id/Teamviewer</label>
                            @foreach($computer as $computers)
                            <input name="idteamviewer" type="text" class="form-control custom-form" value="{{ $computers->idteamviewer }}" placeholder="Digitar ...">
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Setor</label>
                        <select name="setorSelect" class="form-control custom-form">
                            @foreach($computer as $computers)
                            <option value="{{ $computers->setor }}" selected>{{ $computers->setor }}</option>
                            @endforeach
                            <option value="Administrativo/Financeiro">Administrativo/Financeiro</option>
                            <option value="Suporte/Atendimento">Suporte/Atendimento</option>
                            <option value="Auxiliar Administrativo">Auxiliar Administrativo</option>
                            <option value="Depto Analise e Desenvolvimento">Depto Analise e Desenvolvimento</option>
                            <option value="Gestão Infraestrutura">Gestão Infraestrutura</option>
                            <option value="Gestão de Qualidade">Gestão de Qualidade</option>
                            <option value="Sala de Reunião">Sala de Reunião</option>
                            <option value="Supervisão do Setor de Qualidade">Supervisão do Setor de Qualidade</option>
                            <option value="Supervisor - Suporte e Atendimento">Supervisor - Suporte e Atendimento</option>
                            <option value="Supervisor TI">Supervisor TI</option>
                            <option value="Projetos">Projetos</option>
                            <option value="Recepção">Recepção</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nome/Usuário (*)</label>
                            @foreach($computer as $computers)
                            <input name="nomeUsuario" value="{{ $computers->nomeUsuario }}" class="form-control custom-form" rows="3" placeholder="Nome de usuário de logon no windows ou linux ..." />
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Número/Remoto (*)</label>
                            @foreach($computer as $computers)
                            <input class="form-control custom-form" rows="3" placeholder="Digitar ..." value="{{ $computers->numeroRemoto}}" />
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Ramal/Telefone</label>
                            @foreach($computer as $computers)
                            <input name="ramalTelefone" value="{{ $computers->ramalTelefone }}" class="form-control custom-form" rows="3" placeholder="Digitar ..." />
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Endereço/Ipv4</label>
                            @foreach($computer as $computers)
                            <input name="ipv4" value="{{ $computers->ipv4 }}" class="form-control custom-form" rows="3" placeholder="0.0.0.0/24 ..." />
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Link/Saida</label>
                            @foreach($computer as $computers)
                            <input name="linkSaida" value="{{ $computers->linkSaida }}" class="form-control custom-form" rows="3" placeholder="0.0.0.0/24 ..." />
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Qtd/Memoria</label>
                            <select name="qtdMemoria" class="form-control custom-form">
                                @foreach($computer as $computers)
                                <option value="{{ $computers->qtdMemoria }}" selected>{{ $computers->qtdMemoria }}</option>
                                @endforeach
                                <option value="4GB">4GB</option>
                                <option value="8GB">8GB</option>
                                <option value="16GB">16GB</option>
                                <option value="24GB">24GB</option>
                                <option value="48GB">48GB</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Sistema Operacional</label>
                            <select name="sisOperacional" class="form-control custom-form">
                                @foreach($computer as $computers)
                                <option value="{{ $computers->sisOperacional }}" selected>{{ $computers->sisOperacional }}</option>
                                @endforeach
                                <option value="Windows XP (NT 5.1)">Windows XP (NT 5.1)</option>
                                <option value="Windows Server 2003 (NT 5.2)">Windows Server 2003 (NT 5.2)</option>
                                <option value="Windows Vista (NT 6.0)">Windows Vista (NT 6.0)</option>
                                <option value="Windows Server 2008">Windows Server 2008</option>
                                <option value="Windows Server 2012">Windows Server 2012</option>
                                <option value="Windows Server 2016">Windows Server 2016</option>
                                <option value="Windows Server 2019">Windows Server 2019</option>
                                <option value="Windows 7">Windows 7</option>
                                <option value="Windows 8">Windows 8</option>
                                <option value="Windows 10">Windows 10</option>
                                <option value="Windows 11">Windows 11</option>
                                <option value="Linux">Linux</option>
                                <option value="Outros">Outros</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Vinculo de Licença</label>
                            <select name="vinculoLicenca" class="form-control custom-form">
                                @foreach($computer as $computers)
                                <option value="{{ $computers->vinculoLicenca }}" selected>{{ $computers->vinculoLicenca }}</option>
                                @endforeach
                                <option value="Microsoft VLSC">Microsoft VLSC</option>
                                <option value="Rupave">Rupave</option>
                                <option value="RR Softwares">RR Softwares</option>
                                <option value="Open Source">Open Source</option>
                                <option value="Outros">Outros</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Monitor 1</label>
                        <select name="monitorPrimario" class="form-control custom-form">
                            @foreach($computer as $computers)
                            <option value="{{ $computers->monitor_primario }}" selected>{{ $computers->monitor_primario }}</option>
                            @endforeach
                            @foreach($monitor as $monitores)
                            <option value="{{ $monitores->fabricante }}/{{ $monitores->polegadas }}P">{{ $monitores->fabricante }}/{{ $monitores->polegadas }}P</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Monitor 2</label>
                        <select name="monitorSecundario" class="form-control custom-form">
                            @foreach($computer as $computers)
                            <option value="{{ $computers->monitor_secundario }}" selected>{{ $computers->monitor_secundario }}</option>
                            @endforeach
                            @foreach($monitor as $monitores)
                            <option value="{{ $monitores->fabricante }}/{{ $monitores->polegadas }}P">{{ $monitores->fabricante }}/{{ $monitores->polegadas }}P</option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <h4></h4>
                    <div class="form-group">
                        <label for="floatingInput">HD Primario</label>
                        <!-- checkbox pool-->
                        @foreach($computer as $computers)
                        <input type="text" name="tags_hd_primario" style="text-transform:uppercase;" class="form-control custom-form tagin" id="hd_primario" value="{{ $computers->tags_hd_primario }}">
                        @endforeach

                        <label for="floatingInput">Hd Secundário</label>
                        <!-- checkbox pool-->
                        @foreach($computer as $computers)
                        <input type="text" name="tags_hd_secundario" style="text-transform:uppercase;" class="form-control custom-form tagin" id="hd_secundario" value="{{ $computers->tags_hd_secundario }}">
                        @endforeach
                    </div>
                    <hr>
                    <div class="form-group">

                        <!-- checkbox pool-->
                        <label>Programas Utilizados o/u Instalados</label>
                        <!-- checkbox pool-->
                        @foreach($computer as $computers)
                        <input type="text" name="tags_programas" class="form-control custom-form tagin" id="tags_programas" value="{{ $computers->programasInstalados  }}" />
                        @endforeach
                        <hr>
                        <!-- checkbox pool fim-->
                        <label>Sistemas/Quality</label>
                        @foreach($computer as $computers)
                        <input type="text" name="tags_qsistemas" class="form-control custom-form tagin" id="sistemasQs" value="{{ $computers->sistemasQs }}" />
                        @endforeach

                    </div>
                    <br />
                    <hr>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-block btn-primary btn-lg btn-custom">Salvar</button>
                        <a href="{{ route('admin.show.all.computers') }}"><button type="button" class="btn btn-block btn-danger btn-lg btn-custom-cancel">Cancelar</button>
                    </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    @push('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://unpkg.com/tagin@2.0.2/dist/tagin.min.js"></script>
    <script>
        function taginTag(query) {
            var dados = new Tagin(query);
            return dados;
        }

        var tags_programas = document.querySelector('#tags_programas');
        var SistemasQs = document.querySelector('#sistemasQs');
        var hd_primario = document.querySelector('#hd_primario');
        var hd_secundario = document.querySelector('#hd_secundario');

        taginTag(tags_programas);
        taginTag(SistemasQs);
        taginTag(hd_primario);
        taginTag(hd_secundario);

        //loading
        $(function() {
            $("form").submit(function(resultado) {
                $('#loader').show().fadeOut(1800);
            });
        });
    </script>
    @endpush
    @endsection