<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sistema extends Model
{
    use HasFactory;

    protected $connection = "backup";

    protected $table = 'bkp_sistemas';

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'sistemas'];

}
