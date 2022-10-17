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
                    <h1>Cadastro</h1>
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
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title"><i class="nav-icon fa fa-terminal" aria-hidden="true" nav-icon></i> Servidores </h3>
        </div><br />
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{ route('admin.server.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
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
                    <div class="alert alert-success"s style="text-align:center">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="col-sm-6">
                        <!-- text input -->
                        <label>Interna/Externa</label>
                        <table>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input interna" type="checkbox" name="interna" value="interna" id="flexCheckDefault" onclick="checkbox()">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Rede Interna (Quality *)
                                            </label>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input externa" type="checkbox" name="externa" value="externa" id="flexCheckChecked" onclick="checkbox()">
                                            <label class="form-check-label" for="flexCheckChecked">
                                                Rede Externa (Eveo cloud *)
                                            </label>
                                        </div>
                                    </div>
                                </td>
                        </table>
                        <div class="sacServidores">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Hostname (*)</label>
                        <input name="hostname" type="text" class="form-control" placeholder="desktop-pc01 ...">
                    </div>
                    <div class="form-group">
                        <label>Tipo/Serviço</label>
                        <select name="tipoServico" class="form-control">
                            <option selected="">Escolher...</option>
                            <option value="Backup/FTP">Backup/FTP</option>
                            <option value="Proxy/Reverso">Proxy/Reverso</option>
                            <option value="Router/Borda">Router/Borda</option>
                            <option value="Storage">Storage</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Endereço/Ipv4</label>
                            <input name="ipv4" class="form-control" rows="3" placeholder="0.0.0.0/24 ..." />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Link/Saida</label>
                            <input name="linkSaida" class="form-control" rows="3" placeholder="0.0.0.0/24 ..." />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Qtd/Memoria</label>
                            <select name="qtdMemoria" class="form-control">
                                <option selected="">Escolher...</option>
                                <option value="4GB">4GB</option>
                                <option value="16GB">16GB</option>
                                <option value="24GB">24GB</option>
                                <option value="48GB">48GB</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Sistema Operacional</label>
                            <select name="sisOperacional" class="form-control">
                                <option selected="">Escolher...</option>
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

                    <div class="form-group">
                        <label>Vinculo de Licença</label>
                        <select name="vinculoLicenca" class="form-control">
                            <option selected="">Escolher...</option>
                            <option selected>Escolher...</option>
                            <option value="Microsoft VLSC">Microsoft VLSC</option>
                            <option value="Rupave">Rupave</option>
                            <option value="RR Softwares">RR Softwares</option>
                            <option value="Open Source">Open Source</option>
                            <option value="Outros">Outros</option>
                        </select>
                    </div>
                    <hr>
                    <h4></h4>
                    <div class="form-group">
                        <label for="floatingInput">HD Primario</label>
                        <!-- checkbox pool-->
                        <input type="text" name="tags_hd_primario" style="text-transform:uppercase;" class="form-control tagin" id="hd_primario" value="">

                        <label for="floatingInput">Hd Secundário</label>
                        <!-- checkbox pool-->
                        <input type="text" name="tags_hd_secundario" style="text-transform:uppercase;" class="form-control tagin" id="hd_secundario" value="">
                    </div>
                    <hr>
                    <div class="form-group">

                        <!-- checkbox pool-->
                        <label>Programas Utilizados o/u Instalados</label>
                        <!-- checkbox pool-->

                        <input type="text" name="tags_programas" class="form-control tagin" id="programasInstalados" value="exemplo Apache2" />

                        <hr>
                        <!-- checkbox pool fim-->
                        <label>Sistemas/Quality</label>

                        <input type="text" name="tags_qsistemas" class="form-control tagin" id="sistemasQs" value="exemplo ServidorPai-Serviço" />

                    </div>


                    <div class="form-group">
                        <label>Anexar imagens</label>
                        <div class="input-group control-group increment">
                            <input type="file" name="filename[]" class="form-control">
                            <div class="input-group-btn">
                                <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Adicionar</button>
                            </div>
                        </div>
                        <div class="clone hide">
                            <div class="control-group input-group" style="margin-top:10px">
                                <input type="file" name="filename[]" class="form-control">
                                <div class="input-group-btn">
                                    <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                </div>
                            </div>
                        </div>
                        <br />
                        <hr>
                        <button type="submit" class="btn btn-block btn-primary btn-lg">Salvar</button><br />
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://unpkg.com/tagin@2.0.2/dist/tagin.min.js"></script>
    <script src="{{ asset('backend/js/create-server.js') }}"></script>
    <script>
        //loading
        $(function() {
            $("form").submit(function(resultado) {
                $('#loader').show().fadeOut(1800);
            });
        });
    </script>
    @endpush
    @endsection