<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackupsAtrasados extends Model
{
    use HasFactory;

    protected $table = "backups_atrasados";

    protected $fillable = [
        'id_entidade',
        'id_sistemas',
        'corrompido',
        'tamanho_banco',
        'datahora_envio',
        'psm_entity',
        'total'
    ];
}
