<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    use HasFactory;

    protected $table = "computers";

    protected $fillable = [
        'filename',
        'hostname',
        'idteamviewer',
        'setor',
        'nomeUsuario',
        'numeroRemoto',
        'ipv4',
        'linkSaida',
        'qtdMemoria',
        'sisOperacional',
        'vinculoLicenca',
        'tags_hd_primario',
        'tags_hd_secundario',
        'monitor_primario',
        'monitor_secundario',
        'ramalTelefone',
        'programasInstalados',
        'sistemasQs',
        'user_id',
        'created_at',
        'updated_at'
    ];

}
