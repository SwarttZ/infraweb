<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Switchs extends Model
{
    use HasFactory;

    protected $table = "switchs";
    
    protected $fillable = [
        'fabricante',
        'serial',
        'qtdPortas',
        'localizacao',
        'observacoes',
        'user_id'
    ];
}
