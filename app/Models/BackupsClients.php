<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class BackupsClients extends Model
{
    use HasFactory;

    /**
     * The database connection that should be used by the model.
     *
     * @var string
     */
    protected $connection = "backup";

    protected $table = 'envio_autom';

    public $timestamps = false;

    protected $fillable = [

        'id_entidade',
        'id_sistema',
        'corrompido',
        'tamanho_banco',
        'datahora_envio',

    ];
}
