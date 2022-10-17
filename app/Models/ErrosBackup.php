<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrosBackup extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $table = 'erros_backups';

    protected $fillable = [
        'entidade_id',
        'nome_servidor',
        'mensagem_erro',
        'data_backup'
    ];
}
