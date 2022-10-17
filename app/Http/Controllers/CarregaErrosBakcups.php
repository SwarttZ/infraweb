<?php

namespace App\Http\Controllers;

use App\Models\BackupsErros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDOException;
use App\Repositories\Repository;

class CarregaErrosBakcups extends Controller
{
    protected $model;

    public function __construct(BackupsErros $backups)
    {
        $this->model = new Repository($backups);
        $this->backups = $backups;
    }

    public function returnAjax()
    {
        $erro_bakcup = DB::connection('backup')->select("SELECT entidade_id, nome_servidor, mensagem_erro, data_backup FROM bkp_erro LIMIT 200");
        DB::table('erros_backup_mensagem')->truncate();
        try {
            foreach ($erro_bakcup as $erro) {
                $this->backups->create([
                    'entidade_id' => $erro->entidade_id,
                    'nome_servidor' => $erro->nome_servidor,
                    'mensagem_erro' => $erro->mensagem_erro,
                    'data_backup' => $erro->data_backup,
                ]);
            }
            $resultado['resultado'] = true;
            return json_encode($resultado);
        } catch (PDOException $exception) {
            $resultado['resultado'] = 'Erro com o banco: ' . $exception;
            return json_encode($resultado);
        }
    }
    public function delete()
    {
        try {
            DB::table('erros_backup_mensagem')->truncate();
            return json_encode(true);
        } catch (PDOException $exception) {
            return json_encode('Erro banco de dados: ' . $exception);
        }
    }
    public function update()
    {
        $dt = date('Y-m-d');
        $error = DB::connection('backup')->select("SELECT entidade_id, nome_servidor, mensagem_erro, data_backup FROM bkp_erro WHERE data_backup LIKE '%$dt%'");
        try {
            foreach ($error as $erro_backup) {

                $backup = new BackupsErros();
                $backup->entidade_id = $erro_backup->entidade_id;
                $backup->nome_servidor = $erro_backup->nome_servidor;
                $backup->mensagem_erro = $erro_backup->mensagem_erro;
                $backup->data_backup = $erro_backup->data_backup;

                $backup->save();
            }
            return json_encode(true);
        } catch (PDOException $exception) {
            return json_encode('Erro com o banco de dados: ' . $exception);
        }
    }
}
