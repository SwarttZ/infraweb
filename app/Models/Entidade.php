<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entidade extends Model
{
    use HasFactory;

    protected $connection = "backup";

    protected $table = 'bkp_entidades';

    public $timestamps = false;

    protected $primaryKey = 'id_entidade';

    protected $fillable = ['id_entidade', 'entidade'];
}
