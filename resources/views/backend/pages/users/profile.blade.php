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
                    <h1>Área Admin</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Perfil</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @foreach($user_id as $key => $value)
                                @if(Auth()->user()->id == $value->user_id)
                                <img class="profile-user-img img-fluid img-circle" src="{{ asset('backend/img/profile/' . $value->photo) }}" alt="Foto do usuário">
                                @endif
                                @endforeach
                            </div>

                            @foreach($users as $user)
                            @if($user->level < 1) <h3 class="profile-username text-center">{{ $user->name }}</h3>
                                <p class="text-muted text-center">Usuário</p>
                                @else
                                <h3 class="profile-username text-center">{{ $user->name }}</h3>
                                <p class="text-muted text-center">Administrador</p>
                                @endif
                                @endforeach

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">

                                    </li>
                                </ul>
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                                    Alterar Senha
                                </button>

                                <!-- Modal -->

                                <div class="modal fade" id="modal-default">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Resetar senha admin</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="quickForm">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Nome Usuário (*)</label>
                                                        <input type="text" id="name" name="name" class="form-control" id="nome" value="{{ auth()->user()->name }}" disabled>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Senha (*)</label>
                                                        <input type="password" id="password" name="password" class="form-control" placeholder="senha">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Repetir Senha (*)</label>
                                                        <input type="password" id="password2" name="password2" class="form-control" placeholder="repetir senha">
                                                    </div>

                                                </form>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-primary" id="btnSalvar" onclick="sendRequestAjax()">Salvar</button>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->

                        </div>
                        <!-- /.card-body -->
                    </div>

                    @include('backend.pages.users.settings')
                    @include('backend.pages.users.list')

                    @push('scripts')
                    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
                    <script src="https://unpkg.com/tagin@2.0.2/dist/tagin.min.js"></script>
                    <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
                    <script>
                        $(function() {

                            $('#quickForm').validate({
                                rules: {

                                    password: {
                                        required: true
                                        , minlength: 6
                                    , }
                                    , password2: {
                                        required: true
                                        , minlength: 6
                                        , equalTo: "#password"
                                    },

                                }
                                , messages: {
                                    password: {
                                        required: "Campo obrigatório"
                                        , minlength: "Sua senha tem que ser maior que 6 Caracteres"
                                        , equalTo: "Atenção as senhas não combinam"
                                    }
                                    , password2: {
                                        required: "Campo obrigatório"
                                        , minlength: "Sua senha tem que ser maior que 6 Caracteres"
                                        , equalTo: "Atenção as senhas não combinam"

                                    }
                                , }
                                , errorElement: 'span'
                                , errorPlacement: function(error, element) {
                                    error.addClass('invalid-feedback');
                                    element.closest('.form-group').append(error);
                                }
                                , highlight: function(element, errorClass, validClass) {
                                    $(element).addClass('is-invalid');
                                }
                                , unhighlight: function(element, errorClass, validClass) {
                                    $(element).removeClass('is-invalid');
                                }
                            });
                        });

                        function sendRequestAjax() {

                            var name = $('#name').val();
                            var password = $('#password').val();
                            var password2 = $('#password2').val();

                            $.ajaxSetup({
                                beforeSend: function(xhr, type) {
                                    if (!type.crossDomain) {
                                        xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                                    }
                                }
                            , });
                            $.ajax({
                                url: "/dashboard/profile/update-password"
                                , data: {
                                    name: name
                                    , password: password
                                    , password2: password2
                                }
                                , dataType: "json"
                                , method: "POST"
                                , success: function(result) {
                                    if (result.resultado === true) {
                                        $('#loader');
                                        loader.style.display = 'none';
                                        Swal.fire({
                                            icon: 'success'
                                            , title: 'Óla...'
                                            , text: 'Senha alterada com sucesso!'
                                            , footer: ''
                                        })
                                    } else {
                                        $('password').val('');
                                        $('password2').val('');
                                        $('#loader').hide();
                                        Swal.fire({
                                            icon: 'error'
                                            , title: 'Oops...'
                                            , text: 'Algo deu errado!'
                                            , footer: '<a href="">Contato suporte?</a>'
                                        })
                                    }
                                }
                            , });
                        }

                        //loader
                        $(function() {
                            $("form").submit(function(resultado) {
                                $('#loader').show();
                            });
                        });

                    </script>
                    @endpush
                    @endsection
