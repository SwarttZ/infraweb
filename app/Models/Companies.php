<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;

    protected $table = "companies";

    protected $fillable = [
        'image',
        'address',
        'shortName',
        'fullName',
        'email',
        'phone1',
        'phone2',
        'mayor',
        'cnpjCpf',
        'im',
        'city',
        'state',
        'active'
    ];
    public function getState()
    {
        return $this->belongsTo('App\Models\State', 'state', 'id');
    }

    public function getCity()
    {
        return $this->belongsTo('App\Models\City', 'city', 'id');
    }
}
