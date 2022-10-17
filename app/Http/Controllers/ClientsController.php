<?php

namespace App\Http\Controllers;

use App\Models\BackupsAtrasados;
use App\Repositories\Repository;
use App\Models\BackupsCorrompidos;
use Illuminate\Support\Facades\DB;
use PDO;

class ClientsController extends Controller
{
    protected $model;

    public function __construct(BackupsAtrasados $backups, BackupsCorrompidos $corrompidos)
    {
        $this->model = new Repository($backups);
        $this->backups = $backups;

        $this->model = new Repository($corrompidos);
        $this->corrompido = $corrompidos;
    }
    public function index()
    {
        $system = DB::connection('backup')->table('bkp_sistemas')->get();
        $psm_entity = DB::connection('sac')->table('psm_entitys')->get();
        $corrompidos = $this->corrompido->all();
        $backupsAtrasados = $this->backups->all();
        $sistemas_ativo = DB::connection('intranet')->table('clientesistema')->get();
        $entity_backup = DB::connection('intranet')->table('entidades')->get();


        $_host = "177.93.109.237:45392";
        $_db = "backup";
        $_user = "root";
        $_pass = "QSYonm75699";


        $pdo = new PDO("mysql:host=$_host;dbname=$_db;charset=utf8", $_user, $_pass);

        return view('backend.pages.clients.backups', [
            'system' => $system,
            'psm_entity' => $psm_entity,
            'backupsAtrasados' => $backupsAtrasados,
            'pdo' => $pdo,
            'sistemas_ativo' => $sistemas_ativo,
            'corrompidos' => $corrompidos,
            'entity_backup' =>   $entity_backup
        ]);
    }
    public function ajaxLoad()
    {
        $backupsAtrasados = $this->backups->all();
        $resultado['resultado'] = $backupsAtrasados;
        return response()->json($resultado);
    }
}
