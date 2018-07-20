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
}
