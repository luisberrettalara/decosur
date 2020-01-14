<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos\Producto;

class ProductosController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.show')->with('producto', $producto);
    }
}
