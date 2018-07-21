<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Cliente extends Model
{
    use Notifiable;
    protected $fillable = [
        'nombre_completo', 'carnet_identidad', 'direccion','telefono','sexo'
    ];

    public function factura(){
        return $this->belongsTo(Factura::class);//no funciona si tiene null

    }
}
