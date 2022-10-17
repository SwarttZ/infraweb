<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servers extends Model
{
    use HasFactory;

    protected $table = "servers";

    protected $fillable = [
        'filename',
        'hostname',
        'tipoServico',
        'ipv4',
        'linkSaida',
        'qtdMemoria',
        'sisOperacional',
        'vinculoLicenca',
        'tags_hd_primario',
        'tags_hd_secundario',
        'programasInstalados',
        'sistemasQ',
        'user_id'
    ];
}
