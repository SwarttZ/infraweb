@extends('backend.layout.master')

@section('title', 'dashboard')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                        <li class="breadcrumb-item active">Impressoras</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
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
    <section class="content">
        <div class="container-fluid">
            <div class="row row-users">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="nav-icon fa fa-user" aria-hidden="true" nav-icon></i> Usuários </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" action="{{ route('admin.store.user') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nome Usuário (*)</label>
                                    <input type="text" name="nome" class="form-control" id="nome" placeholder="nome completo">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email (*)</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Senha (*)</label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="senha">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Repetir Senha (*)</label>
                                    <input type="password" name="password2" class="form-control" id="exampleInputPassword2" placeholder="repetir senha">
                                </div>
                                <div class="form-group mb-0">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                                        <label class="custom-control-label" for="exampleCheck1">Concorda com os termos? <a href="#">termos e serviços</a>.</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                @push('scripts')
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
                <script src="https://unpkg.com/tagin@2.0.2/dist/tagin.min.js"></script>
                <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
                <script>
                    $(function() {

                        $('#quickForm').validate({
                            rules: {
                                email: {
                                    required: true,
                                    email: true,
                                },
                                nome: {
                                    required: true,
                                },
                                password: {
                                    required: true,
                                    minlength: 5,
                                    equalTo: "#exampleInputPassword2"
                                },
                                password2: {
                                    required: true,
                                    minlength: 5,

                                },
                                terms: {
                                    required: true
                                },
                            },
                            messages: {
                                nome: {
                                    required: "Campo obrigatório"
                                },
                                email: {
                                    required: "Campo obrigatório!",
                                    email: "Por favor digite um email válido: fulano@email.com"
                                },
                                password2: {
                                    required: "Campo obrigatório",
                                    minlength: "Sua senha tem que ser maior que 5 Caracteres"
                                },
                                password: {
                                    required: "Campo obrigatório",
                                    minlength: "Sua senha tem que ser maior que 5 Caracteres",
                                    equalTo: "Atenção as senhas não combinam"
                                },
                                terms: "Porfavor aceite os termos"
                            },
                            errorElement: 'span',
                            errorPlacement: function(error, element) {
                                error.addClass('invalid-feedback');
                                element.closest('.form-group').append(error);
                            },
                            highlight: function(element, errorClass, validClass) {
                                $(element).addClass('is-invalid');
                            },
                            unhighlight: function(element, errorClass, validClass) {
                                $(element).removeClass('is-invalid');
                            }
                        });
                    });

                    //loading
                    $(function() {
                        $("form").submit(function(resultado) {
                            $('#loader').show().fadeOut(1800);
                        });
                    });
                </script>
                @endpush
                @endsection