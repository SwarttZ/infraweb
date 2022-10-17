@extends('backend.layout.master')

@section('title', 'dashboard')

@section('content')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://unpkg.com/tagin@2.0.2/dist/tagin.min.css">
@endpush
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
<style rel="stylesheet">
    .grind-actions {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        grid-gap: 0px;

    }

    .form-control {
        width: 215%;
    }

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Backups do sistema</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Backup</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section><br />
    <form action="{{ route('admin.backup.generate') }}" method="POST">
        @csrf
        <div class="grind-actions">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Database (*)</label>
                    <input name="database" type="text" class="form-control" placeholder="nome-banco ...">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Usuário (*)</label>
                    <input name="user" type="text" class="form-control" placeholder="root ...">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Senha (*)</label>
                    <input name="password" type="text" class="form-control" placeholder="senha* ...">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Backup</label>
                    <button type="submit" class="btn btn-success bi bi-hdd">Gerar</button>
                </div>
            </div>
    </form>
</div>
<hr>
<div class="container-computer-table">
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>ARQUIVO</th>
                <th>DATA</th>
                <th>AÇÕES</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
@push('scripts')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://unpkg.com/tagin@2.0.2/dist/tagin.min.js"></script>
<script>
    //loading
    $(function() {
        $("form").submit(function() {
            $('#loader').show();
        });
    });

</script>
@endpush
@endsection
