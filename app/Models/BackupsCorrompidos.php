<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackupsCorrompidos extends Model
{
    use HasFactory;

    protected $table = "corrompidos";

    protected $fillable = [
        'id_entidade',
        'id_sistemas',
        'corrompido',
        'tamanho_banco',
        'datahora_envio',
    ];
}
