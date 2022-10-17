<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ErrosBackupsController extends Controller
{
    public function index()
    {
        $erros_backups = DB::table('erros_backup_mensagem')->orderBy('created_at', 'desc')->paginate(10);
        return view(
            'backend.pages.erros_backup.index',
            [
                'erros_backups' => $erros_backups,
            ]
        );
    }
}
