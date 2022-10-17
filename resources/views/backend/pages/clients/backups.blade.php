@extends('backend.layout.master')

@section('title', 'dashboard')

@section('content')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://unpkg.com/tagin@2.0.2/dist/tagin.min.css">
<style rel="stylesheet">
    ion-icon {
        --ionicon-stroke-width: 30px;
        color: blue;
    }
</style>
@endpush
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
<div class="container-datatable">
    <div class="card-body">
        <div class="callout callout-danger">
            <h5>Informações!</h5>
            <ul>
                <li>
                    Banco de dados não corrompido icone: <ion-icon name="checkmark-circle-outline"></ion-icon>
                </li>
                <li>
                    Banco de dados corrompido icone <ion-icon name="close-circle-outline"></ion-icon>
                </li>
            </ul>
            <div class="container-buttons-erros-backup">
                <form id="formUpdateTable"> Atualize a tabela: <button type="submit" class="btn btn-primary bi bi-arrow-counterclockwise" onclick="atualizaTabela()"></button></form>
                <form id="formCorrompidos"> Listar bancos corrompidos: <input type="date" id="data" name="data"/><button type="submit" class="btn btn-warning bi bi-box-arrow-up" onclick="carregaBancosCorrompidos()"></button></form>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Atrasados</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Corrompidos</button>
            </div>
        </nav>


        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <table id="table-backups" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Entidade</th>
                            <th>Sistemas</th>
                            <th>Tamanho/Bytes</th>
                            <th>Data</th>
                            <th>Corrompido</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($backupsAtrasados as $key => $value)
                        @php
                        $sql = $pdo->prepare("SELECT bkp_nomeservidor FROM app_bkp WHERE bkp_nomeservidor NOT LIKE '%TEMP%'
                        AND bkp_nomeservidor NOT LIKE '%SRVSIMUL%'
                        AND bkp_entidade_id = '" .$value->id_entidade. "' AND bkp_nomeservidor IS NOT NULL LIMIT 1");
                        $sql->execute();
                        $query = $sql->fetchAll();
                        @endphp
                        @if($value->datahora_envio < date('y-m-d 00:00:00')) <tr>
                            <td style="text-align:center;">
                                @foreach($query as $Key => $data)
                                @if($data['bkp_nomeservidor'] != "SIMUL")
                                {{ $data['bkp_nomeservidor'] }}
                                @endif
                                @endforeach
                            </td>
                            <td style="text-align:center;">
                                {{ $value->id_sistemas }}
                            </td>
                            <td style="text-align:center;">
                                @if($value->tamanho_banco == 0 || empty($value->tamanho_banco) || $value->tamanho_banco < 16 ) <p style="color:red;">{{ $value->tamanho_banco }}</p>
                                    @else
                                    <p style="color:green;">{{ $value->tamanho_banco }}</p>
                                    @endif
                            </td>
                            <td style="text-align:center;">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->datahora_envio)->format('d/m/Y H:i:s') }}
                            </td>
                            <td style="text-align:center;">
                                @if(is_int($value->tamanho_banco) || $value->tamanho_banco != "NAN" || $value->tamanho_banco!= 0)
                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                                @else
                                <ion-icon name="close-circle-outline"></ion-icon>
                                @endif
                            </td>
                            </tr>
                            @endif
                            @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Entidade</th>
                            <th>Sistemas</th>
                            <th>Tamanho/Bytes</th>
                            <th>Data</th>
                            <th>Corrompido</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!--Table corrupted-->
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <table id="table-corrompidos" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Entidade</th>
                            <th>Sistema</th>
                            <th>Tamanho/Bytes</th>
                            <th>Data</th>
                            <th>Corrompido</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($corrompidos as $value)
                        @php
                        $sql = $pdo->prepare("SELECT bkp_nomeservidor FROM app_bkp WHERE bkp_nomeservidor NOT LIKE '%TEMP%'
                        AND bkp_nomeservidor NOT LIKE '%SRVSIMUL%'
                        AND bkp_entidade_id = '" .$value['id_entidade']. "' AND bkp_nomeservidor IS NOT NULL LIMIT 1");
                        $sql->execute();
                        $query = $sql->fetchAll();

                        $sql_sistema = $pdo->prepare("SELECT sistemas FROM bkp_sistemas WHERE id = '" .$value['id_sistemas']. "'");
                        $sql_sistema->execute();
                        $query_sistema = $sql_sistema->fetchAll();
                        @endphp
                        <tr>
                            <td>
                                @foreach($query as $data)
                                {{ $data['bkp_nomeservidor'] }}
                                @endforeach
                            </td>
                            <td>
                                @foreach($query_sistema as $data)
                                {{ $data['sistemas'] }}
                                @endforeach
                            </td>
                            <td>{{ $value->tamanho_banco }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->datahora_envio)->format('d/m/Y H:i:s') }}</td>
                            <td>
                                <ion-icon name="close-circle-outline"></ion-icon>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Entidade</th>
                            <th>Sistema</th>
                            <th>Tamanho/Bytes</th>
                            <th>Data</th>
                            <th>Corrompido</th>
                        </tr>
                    </tfoot>
                </table>
                <!-- End table corrupted -->
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!-- /.container datatable-->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>
    $(function() {
        $("#table-backups").DataTable({
            "responsive": true
            , "lengthChange": false
            , "autoWidth": false
            , "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            , "language": {
                "lengthMenu": "Exibir _MENU_ registros por pagina"
                , "zeroRecords": "Zero dados"
                , "info": "Mostrando pagina _PAGE_ de _PAGES_"
                , "infoEmpty": "Backups atrasados"
                , "infoFiltered": "(filtered from _MAX_ total records)"
                , "search": "Buscar:"
                , "paginate": {
                    "first": "Primeira"
                    , "last": "Última"
                    , "next": "Proxima"
                    , "previous": "Anterior"
                }
                , buttons: {
                    "copy": "Copiar"
                    , "print": "Imprimir"
                    , "colvis": "Visualizar colunas"

                }
            }
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true
            , "lengthChange": false
            , "searching": false
            , "ordering": true
            , "info": true
            , "autoWidth": false
            , "responsive": true
        , });
    });


    $(function() {
        $("#table-corrompidos").DataTable({
            "responsive": true
            , "lengthChange": false
            , "autoWidth": false
            , "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            , "language": {
                "lengthMenu": "Exibir _MENU_ registros por pagina"
                , "zeroRecords": "Zero dados"
                , "info": "Mostrando pagina _PAGE_ de _PAGES_"
                , "infoEmpty": "Backups atrasados"
                , "infoFiltered": "(filtered from _MAX_ total records)"
                , "search": "Buscar:"
                , "paginate": {
                    "first": "Primeira"
                    , "last": "Última"
                    , "next": "Proxima"
                    , "previous": "Anterior"
                }
                , buttons: {
                    "copy": "Copiar"
                    , "print": "Imprimir"
                    , "colvis": "Visualizar colunas"

                }
            }
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true
            , "lengthChange": false
            , "searching": false
            , "ordering": true
            , "info": true
            , "autoWidth": false
            , "responsive": true
        , });
    });

</script>
<script src="{{ asset('backend/js/ajaxUpdateTable.js') }}"></script>
@endpush
@endsection
