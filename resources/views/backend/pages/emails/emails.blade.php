@extends('backend.layout.master')

@section('title', 'dashboard')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Adicionar um novo modelo de email</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Emails</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <textarea id="details">
    </textarea><br />
    <div class="row">
        <div class="col-12">
            <a href="#" class="btn btn-secondary">Cancelar</a>
            <input type="submit" value="Salvar" class="btn btn-success float-right">
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.ckeditor.com/4.18.0/full/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('details', {
            filebrowserUploadUrl: "{{route('admin.news.upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form',
        });
    </script>
    @endpush
    @endsection