<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    public $table = "states";


    public $fillable = [
        "id",
        "uf",
        "name",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        "id" => "integer",
        "uf" => "string",
        "name" => "string"
    ];
}
