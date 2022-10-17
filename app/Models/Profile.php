<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'table_profile';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'photo',
        'created_at',
        'updated_at'
    ];
}
