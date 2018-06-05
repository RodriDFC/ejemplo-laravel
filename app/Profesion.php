<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesion extends Model
{
    //public $timestamps=false;
    protected $table='profesion';
    protected $fillable = [
        'titulo',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
