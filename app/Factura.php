<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Producto;

class Factura extends Model
{
    protected $fillable = [
        'cliente_id', 'fecha', 'modo_pago'
    ];
    public function productos(){
        return $this->belongsToMany(Producto::class,'detalle_factura');//no funciona si tiene null

    }

}