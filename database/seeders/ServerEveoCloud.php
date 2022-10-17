<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServerEveoCloud extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('servidores_eveo')->query("INSERT INTO `servidores_eveo` (`idservidores`, `eveo_arquivos`, `eveo_hostname`, `eveo_ip_interno`, `eveo_ip_externo`, `eveo_portas`, `eveo_func_server`, `eveo_erros_genericos`, `eveo_logs_erros_apache`, `eveo_logs_servidor`, `eveo_server_ssh`, `eveo_os`, `eveo_server_disco`, `eveo_server_ram`, `eveo_server_dns`, `eveo_create_at`) VALUES
        (59, NULL, 'notafiscal', '192.168.100.33', '177.93.109.13', '80,443', 'Nota Fiscal Eletrônica\r\n', NULL, NULL, NULL, '37922', 'Centos7', '100GB', '4GB', 'notafiscal.qualitysistemas.com.br', '2022-01-28 14:22:02.114022'),
        (60, NULL, 'protocoloweb', '192.168.100.5', '177.93.109.81', '80,443', 'Protocolo Web / Saúde Web / Aviso Licitação', NULL, NULL, NULL, '37922', 'Centos7', '200GB', '4GB', 'protocoloweb.qualitysistemas.com.br,\r\nsaudeweb.qualitysistemas.com.br,\r\navisolicitacao.qualitysistemas.com.br', '2022-01-28 15:20:28.119460'),
        (61, NULL, 'solicitacaoonline', '192.168.100.21', '177.93.109.82', '80,443', 'Solicitação Online / Controle Interno\r\n', NULL, NULL, NULL, '37922', 'Centos7', '20GB', '4GB', 'solicitacaoonline.qualitysistemas.com.br,\r\ncontrolador.qualitysistemas.com.br', '2022-01-28 14:39:31.000000'),
        (62, NULL, 'webquality', '192.168.100.9', '177.93.109.168', '80,443', 'Portal Quality / WebQuality', NULL, NULL, NULL, '37922', 'Centos7', '300GB', '8GB', 'web.qualitysistemas.com.br,\r\nportalquality.qualitysistemas.com.br', '2022-01-28 15:18:48.881278'),
        (63, NULL, 'ftpclientfdb', '192.168.100.35', '177.93.109.176', '80,443', 'FTP Backup FB Clientes / PDF Contábil', NULL, NULL, NULL, '4022', 'Centos7', '1000GB', '4GB', 'bancos.qualitysistemas.com.br,\r\natualizacacoes.qualitysistemas.com.br,\r\nrelatórios.qualitysistemas.com.br', '2022-01-28 17:27:11.224132'),
        (64, NULL, 'intranetquality', '192.168.100.13', '177.93.109.180', '80,443', 'Intranet / Site', NULL, NULL, NULL, '37922', 'Centos7', '50GB', '4GB', 'intranetquality.qualitysistemas.com.br,\r\nqualitysistemas.com.br', '2022-01-28 17:33:10.000000'),
        (65, NULL, 'srvged', '192.168.100.17', '177.93.109.236', '80,443', 'Ged', NULL, NULL, NULL, '37922', 'Centos7', '2000GB', '4GB', 'ged.qualitysistemas.com.br', '2022-01-28 17:49:52.000000'),
        (66, NULL, 'dbappbackup2', '192.168.100.25', '177.93.109.237', '80,443', 'Banco MySQL Backups / PDF Arh', NULL, NULL, NULL, '4022', 'Centos7', '300GB', '2GB', 'bancosdb.qualitysistemas.com.br', '2022-01-28 17:55:34.000000'),
        (67, NULL, 'srvesic', '192.168.100.14', '177.93.109.240', '80,443', 'ESIC / ServerMon / Firebird SAC', NULL, NULL, NULL, '37922', 'Centos7', '120GB', '2GB', 'esic.qualitysistemas.com.br,\r\nmonitor.qualitysistemas.com.br,\r\nmapa.qualitysistemas.com.br', '2022-01-28 18:01:50.000000'),
        (68, NULL, 'appserver', '192.168.100.19', '187.108.196.39', '80,443', 'Webservice ARH Digital', NULL, NULL, NULL, '37922', 'Centos7', '30GB', '2GB', 'appserver.qualitysistemas.com.br', '2022-01-28 18:07:02.000000'),
        (69, NULL, 'srv_contingencia_fdb', '192.168.100.29', '187.108.196.85', '8081,45392', 'Contingência', NULL, NULL, NULL, '34945', 'Windows Server 2019', '150GB', '4GB', '', '2022-01-28 20:30:34.036747'),
        (70, NULL, 'srv_proxy_reverso', '192.168.100.24', '177.93.109.159', '211,9082,8081', 'Proxy Reverso', NULL, NULL, NULL, '37922', 'Debian10', '300GB', '4GB', '', '2022-01-28 20:30:37.325684'),
        (71, NULL, 'srv_react', '192.168.100.6', '177.93.108.80', '80', 'Validador', NULL, NULL, NULL, '22', 'Debian10', '10GB', '2GB', 'validador.qualitysistemas.com.br', '2022-01-28 20:05:17.000000'),
        (72, NULL, 'srv_receita_municipal', '192.168.100.31', '177.93.108.122', '80', 'Receita Municipal Assomasul', NULL, NULL, NULL, '37922', 'Debian10', '30GB', '4GB', 'receitamunicipal.assomasul.org.br', '2022-01-28 20:42:22.000000');");
    }
}
