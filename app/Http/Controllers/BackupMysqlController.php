<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\DbDumper\Databases\MySql;
use stdClass;

class BackupMysqlController extends Controller
{

    public function index()
    {
        return view('backend.pages.backup.index');
    }

    public function GerarBackup(Request $request)
    {
        $message = [
            'database.required' => 'Campo obrigatório database',
            'user.required' => 'Campo obrigatório user',
            'password.required' => 'Campo obrigatório password'
        ];

        $request->validate([
            'database' => 'required',
            'user'   => 'required',
            'password' => 'required'
        ], $message);

        MySql::create()
            ->setDumpBinaryPath(public_path() . '/storage/backups/')
            ->setDbName($this->databaseNome)
            ->setUserName($this->userName)
            ->setPassword($this->password)
            ->dumpToFile('infrawebnovo_' . date('Ydmhi') . '.sql');

            alert()->success('Backup gerado com sucesso');

            return back();
    }
}
