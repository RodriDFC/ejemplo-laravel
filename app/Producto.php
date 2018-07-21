<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Producto extends Model
{
    use Notifiable;
    protected $fillable = [
        'nombre_producto', 'precio', 'fecha_vencimiento','stock'
    ];
    public function factura(){
        return $this->belongsToMany(Factura::class,'detalle_factura');//no funciona si tiene null

    }
}
