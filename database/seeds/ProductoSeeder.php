<?php

use App\Producto;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // fecha ....  año-mes-dia
        Producto::create([
            'nombre_producto'=>'yougurt',
            'precio'=>'1',
            'fecha_vencimiento'=>'2019-2-20',
            'stock'=>'20',
        ]);
        Producto::create([
            'nombre_producto'=>'borrador',
            'precio'=>'3.5',
            'stock'=>'10',
        ]);
    }
}
