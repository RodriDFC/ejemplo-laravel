<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Producto;

class Factura extends Model
{
    protected $fillable = [
        'cliente_id', 'fecha', 'modo_pago','total_pago'
    ];
    public function productos(){
        return $this->belongsToMany(Producto::class,'detalle_factura')//no funciona si tiene null
            ->withPivot('cantidad','precio_total_producto');
                // si se quiere acceder a las demas columnas de la tabla intermedia
                // se debe especificar en withPivot()
                // y en la vista acceder asi...... $var->pivot->columnas

    }
    //1:n......  1 ciente tienes n facturas..... 1 factura pertenece a un cliente entonces
    //belongsTo en facturas
    // el metodo hasOne y hasMany buscara una llave foranea en la otra tabla (parte de n)
    public function cliente(){
        return $this->belongsTo(Cliente::class);//no funciona si tiene null

    }

}