<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Factura;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facturas=Factura::all();//with('cliente')->get();
        return view('factura.facturas',compact('facturas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos=Producto::all()->pluck('nombre_producto');
        return view('factura.crearFactura',compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(request(), [
            'nombre_completo' => 'required',
            'carnet_identidad'=>['required','unique:clientes,carnet_identidad'],
            'direccion'=>'required',
            'telefono'=>'required',
            'nombre_producto'=> ['required','not_in:seleccione una opcion'],
            'precio_unitario'=>'required',
            'cantidad'=>'required',
            'precio_total_producto'=>'required',
            'fecha'=>['required','date'],
            'modo_pago'=> ['required','not_in:seleccione una opcion'],
            'total_pago'=>'required',
        ]);
        DB::transaction(function () use($data){
            $cliente=Cliente::create([
                'nombre_completo'=>$data['nombre_completo'],
                'carnet_identidad'=>$data['carnet_identidad'],
                'direccion'=>$data['direccion'],
                'telefono'=>$data['telefono']
            ]);
            $factura=$cliente->factura()->create([
                'cliente_id'=>$cliente->id,
                'fecha'=>$data['fecha'],
                'modo_pago'=>$data['modo_pago'],
                'total_pago'=>$data['total_pago'],
            ]);
            $idProducto=Producto::where('nombre_producto',$data['nombre_producto'])->value('id');
            $factura->productos()->attach($idProducto,[
                'cantidad'=>$data['cantidad'],
                'precio_total_producto'=>$data['precio_total_producto'],
            ]);
        });

        return redirect()->route('facturas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {
        return view('factura.detalleFactura',compact('factura'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factura $factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        //
    }
}
