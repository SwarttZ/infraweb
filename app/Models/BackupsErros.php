<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackupsErros extends Model
{
    use HasFactory;
    
    protected $table = 'erros_backup_mensagem';
    
    protected $fillable = [

        'entidade_id',
        'nome_servidor',
        'mensagem_erro',
        'data_backup'
    ];
}
