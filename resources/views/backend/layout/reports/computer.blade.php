<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('backend/css/computerReport.css') }}">
    <title>Relatório computadores</title>
</head>
<style rel="stylesheet">
    .styled-table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        font-family: sans-serif;
        min-width: 400px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    .styled-table thead tr {
        background-color: #0e4a81;
        color: #ffffff;
        text-align: left;
    }

    .styled-table th,
    .styled-table td {
        padding: 12px 15px;
        text-align: center;
    }

    .styled-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .styled-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .styled-table tbody tr:last-of-type {
        border-bottom: 2px solid #009879;
    }

    .styled-table tbody tr.active-row {
        font-weight: bold;
        color: #009879;
    }
</style>

<body>
    <div class="container-logo">
        <img src="{{ URL('backend/img/white-logo.png') }}">
    </div>
    <div class="container-titulo">
        <h3 id="titulo">Relatório computadores </h3><br /><br /> Rua 13 de Junho, 59 • Centro • CEP 79002-420 • Campo Grande.MS
        <br />

        <hr>
        <p style="margin-left: -500px;">Usuário: @foreach($computer as $computers) @if($computers->id == $id) {{ $computers->nomeUsuario }} @endif @endforeach</p>
        </h4>
    </div>
    <div class="numero-da-nota">
        <p> @php
            $timezone = array(
            'MS' => 'America/Campo_Grande'
            );
            setlocale(LC_ALL, NULL);
            setlocale(LC_ALL, 'pt_BR');
            date_default_timezone_set($timezone['MS']);
            @endphp
            <li><span>{{ date('H:i A') }} - {{ date('d/m/Y') }}</span></li>
        </p>
    </div>
    <div class="container-table">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Hostname</th>
                    <th>Id/Teamviewer</th>
                    <th>Setor</th>
                    <th>Usuário/Ad</th>
                    <th>Ipv4</th>
                </tr>
            </thead>
            <tbody>
                @foreach($computer as $computers)
                <tr>
                    @if($computers->id == $id)
                    <td>1°</td>
                    <td>{{ $computers->hostname }}</td>
                    <td>{{ $computers->idteamviewer }}</td>
                    <td>{{ $computers->setor }}</td>
                    <td>{{ $computers->nomeUsuario }}</td>
                    <td>{{ $computers->ipv4 }}</td>
                </tr>
                <tr>
                    <th colspan="6">Informações adicionais</th>
                </tr>
                <tr>
                    <th>N°</th>
                    <th>Qtd/Memoria</th>
                    <th>HDs</th>
                    <th colspan="6">Monitor</th>
                </tr>
                <tr>
                    <td>2°</td>
                    <td>{{ $computers->qtdMemoria }}</td>
                    <td>{{ $computers->tags_hd_primario }} {{ $computers->tags_hd_secundario }}</td>
                    <td colspan="6">{{ $computers->monitor }}</td>
                </tr>
                <tr>
                    <th>N°</th>
                    <th>Sistema/Os</th>
                    <th>Vinculo/Licença</th>
                    <th colspan="6">Ramal/Telefone</th>
                </tr>
                <tr>
                    <td>3°</td>
                    <td>{{ $computers->sisOperacional }}</td>
                    <td>{{ $computers->vinculoLicenca }}</td>
                    <td colspan="6">{{ $computers->ramalTelefone }}</td>
                </tr>

                <tr>
                    <th>N°</th>
                    <th>Programas/Quality</th>
                    <th colspan="6">Programas/Terceiros</th>
                </tr>
                <tr>
                    <td>4°</td>
                    <td>{{ $computers->sistemasQs }}</td>
                    <td colspan="6">{{ $computers->programasInstalados }}</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>