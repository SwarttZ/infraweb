<?php

namespace App\Helpers;

use App\Http\Controllers\Controller;
use PDO;
use PDOException;
use App\Models\BackupsAtrasados;
use App\Repositories\Repository;
use App\Http\Controllers\FormatBytesController;
use Illuminate\Support\Facades\DB;
use App\Models\BackupsCorrompidos;
use Illuminate\Http\Request;

//class para atualizar tabela de backups atrasados via ajax

class PdoBackupHelper extends Controller
{
    protected $model;

    public function __construct(BackupsAtrasados $backups, BackupsCorrompidos $backupsCorrompidos)
    {
        $this->model = new Repository($backups);
        $this->backups = $backups;

        $this->model = new Repository($backupsCorrompidos);
        $this->backupsCorrompidos = $backupsCorrompidos;
    }


    public function retornaQuery()
    {
        DB::table('backups_atrasados')->truncate();

        try {
            $_host = "177.93.109.237:45392";
            $_db = "backup";
            $_user = "root";
            $_pass = "QSYonm75699";

            $dt = date('Y-m-d 00:00:00', strtotime('-1 days'));
            $pdo = new PDO("mysql:host=$_host;dbname=$_db;charset=utf8", $_user, $_pass);


            $sql = $pdo->prepare("SELECT id_entidade, sistemas, corrompido, tamanho_banco, datahora_envio,
            datediff(current_date , max(DATAHORA_ENVIO)) 
            as dias_atrasados FROM envio_autom en JOIN bkp_sistemas b on en.id_sistema = b.id WHERE datahora_envio >= '$dt' AND nome_pasta <> '0' 
            AND id_sistema != 5 AND id_entidade not in (0,
            79, 304, 181, 187, 
            273, 354, 173, 34, 336, 
            296, 184, 221, 272, 222, 
            282, 170, 176, 150, 178,
            155, 328, 172, 185, 270,
            33, 340, 288, 177, 113, 91) group by id_entidade, sistemas having datediff(current_date , max(DATAHORA_ENVIO)) 
            between 1 AND 10 order by dias_atrasados asc, id_entidade asc LIMIT 200");

            $sql->execute();
            $ItensBackup = $sql->fetchAll();
            $total = $sql->rowCount();

            $bytes = new FormatBytesController;
            foreach ($ItensBackup as $values) {
                $tamanho = $bytes->formatBytes($values['tamanho_banco']);
                $this->backups->create([
                    'id_entidade' => $values['id_entidade'],
                    'id_sistemas' => $values['sistemas'],
                    'corrompido' => $values['corrompido'],
                    'tamanho_banco' => $tamanho,
                    'datahora_envio' => $values['datahora_envio'],
                    'total' => $total,
                    'dias_atrasados' => $values['dias_atrasados']
                ]);
            }

            $result['resultado'] = true;
            return response()->json($result);
        } catch (PDOException $exception) {
            $result['resultado'] = $exception;
            return response()->json($result);
        }
    }
    public function corrompidos(Request $request)
    {
        DB::table('corrompidos')->truncate();

        try {
            $_host = "177.93.109.237:45392";
            $_db = "backup";
            $_user = "root";
            $_pass = "QSYonm75699";

            $pdo = new PDO("mysql:host=$_host;dbname=$_db;charset=utf8", $_user, $_pass);
            if ($request->query('data') != null && $request->query('data') > 0) {
                $dt = $request->query('data');
                $data = implode('-', array_reverse(explode('/', $dt)));
                $sql = $pdo->prepare("SELECT id_entidade, id_sistema, corrompido, datahora_envio, tamanho_banco FROM 
            envio_autom WHERE corrompido = '1' AND datahora_envio LIKE '%$data%' order by datahora_envio DESC");
            } else {
                $dt_empty = date('Y-m-d');
                $sql = $pdo->prepare("SELECT id_entidade, id_sistema, corrompido, datahora_envio, tamanho_banco FROM 
            envio_autom WHERE corrompido = '1' AND datahora_envio LIKE '%$dt_empty%' order by datahora_envio DESC");
            }
            $sql->execute();
            $ItensBackup = $sql->fetchAll();

            $bytes = new FormatBytesController;
            foreach ($ItensBackup as $values) {
                $tamanho = $bytes->formatBytes($values['tamanho_banco']);
                $this->backupsCorrompidos->create([
                    'id_entidade' => $values['id_entidade'],
                    'id_sistemas' => $values['id_sistema'],
                    'corrompido' => $values['corrompido'],
                    'tamanho_banco' => $tamanho,
                    'datahora_envio' => $values['datahora_envio'],
                ]);
            }
            if (count($ItensBackup) > 0) {
                $result['resultado'] = true;
                return response()->json($result);
            } else {
                $result['resultado'] = false;
                return response()->json($result);
            }
        } catch (PDOException $exception) {
            $result['resultado'] = $exception;
            return response()->json($result);
        }
    }
}
