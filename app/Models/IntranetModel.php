<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntranetModel extends Model
{
    use HasFactory;


    /**
     * The database connection that should be used by the model.
     *
     * @var string
     */
    protected $connection = "intranet";

    protected $table = 'clientesistema';

    public $timestamps = false;

    protected $fillable = [

        'clientesistemas_usuarios_id',
        'clientesistemas_sistemas_id',
        'clientesistemas_versao',
        'clientesistemas_email',
        'clientesistemas_servidor',
        'clientesistemas_data_alteracao',
        'clientesistemas_ip_fixo',
        'clientesistemas_habilitado',
        'clientesistemas_web',
        'clientesistemas_ip_rep'

    ];
}
