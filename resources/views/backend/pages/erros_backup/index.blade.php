@extends('backend.layout.master')

@section('title', 'dashboard')

@section('content')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
@endpush
<div class="container-datatable">
    <div class="card-body">
        <div class="callout callout-danger">
            <h5>Informações!</h5>
            <ul>
                <li>
                    Carregar todos os erros clique no botão abaixo. Atenção esse processo é demorado.
                </li>
            </ul>
            <div class="container-buttons-erros-backup">
                <form id="formUpdateTable"> Atualizar tabela: <button type="submit" class="btn btn-primary bi bi-arrow-counterclockwise" onclick="updateTable()"></button></form>
                <form id="formUpdate"> Carregar todos os erros: <button type="submit" class="btn btn-warning bi bi-box-arrow-up" onclick="carregaTabela()"></button></form>
                <form id="formApagar"> Apagar dados da tabela: <button type="submit" class="btn btn-danger bi bi-trash" onclick="apagar()"></button></form>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="table-backups" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id/Entidade</th>
                    <th>Entidade</th>
                    <th>Mensagem</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach($erros_backups as $key => $erro)
                <tr>
                    <td>{{ $erro->entidade_id }}</td>
                    <td>{{ $erro->nome_servidor }}</td>
                    <td>{{ $erro->mensagem_erro }}</td>
                    <td>{{ $erro->data_backup }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Id/Entidade</th>
                    <th>Entidade</th>
                    <th>Mensagem</th>
                    <th>Data</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<!-- /.container datatable-->

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://unpkg.com/tagin@2.0.2/dist/tagin.min.js"></script>
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

</script>
<script src="{{ asset('backend/js/ajaxErrosBackups.js') }}"></script>
@endpush
@endsection
