<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos\Producto;
Use App\Models\Pedidos\Pedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Session;
use App\Mail\Pedidos\Reserva;

class PedidosController extends Controller
{
    public function __construct()
    {
    	if(!Session::has('pedido')) Session::put('pedido', array());
    }

    public function show()
    {
        if (!Auth::user()) {
            abort(401, 'Acceso no permitido');
        }
    	$pedido = Session::get('pedido');
        $total = $this->total();
    	return view('pedidos.carrito')->with('pedido', $pedido)
                                      ->with('total', $total);
    }

    public function add(Producto $producto)
    {
    	$pedido = Session::get('pedido');
    	$producto->cantidad = 1;
    	$pedido[$producto->id] = $producto;
    	Session::put('pedido', $pedido);

    	return redirect()->route('pedido.show');
    }

    public function update(Producto $producto, $cantidad) {
    	$pedido = Session::get('pedido');
    	$pedido[$producto->id]->cantidad = $cantidad;
    	Session::put('pedido', $pedido);

    	return redirect()->route('pedido.show');
    }

    public function delete(Producto $producto)
    {
    	$pedido = Session::get('pedido');
    	unset($pedido[$producto->id]);
    	Session::put('pedido', $pedido);

    	return redirect()->route('pedido.show');
    }

    public function trash()
    {
    	Session::forget('pedido');

    	return redirect()->route('pedido.show');
    }

    private function total() {
        $pedido = Session::get('pedido');
        $total = 0;
        foreach ($pedido as $item) {
            $total += $item->precio * $item->cantidad;
        }
        return $total;
    }

    public function detallePedido() {
        if (count(Session::get('pedido')) <= 0) {
            return redirect()->route('home');
        }
        $pedido = Session::get('pedido');
        $total = $this->total();
        return view('pedidos.detalle')->with('pedido', $pedido)
                                      ->with('total', $total);
    }

    public function store() {
        $carrito = Session::get('pedido');
        $pedido = new Pedido;
        $pedido->total = $this->total();
        $pedido->usuario_id = Auth::id();
        $pedido->save();
        foreach ($carrito as $idx => $item) {
            $producto = Producto::findOrFail($idx);
            $cantidad = $item->cantidad;
            $precio = $item->precio;
            $pedido->agregarDetalle($producto, $cantidad, $precio);
        }
        $usuario = Auth::user();
        Mail::to(config('mail.from.address'))->send(new Reserva($usuario, $carrito, $this->total()));
        Session::forget('pedido');
        return redirect()->route('home')->with('message', 'Tu reserva se ha realizado con éxito, recordá que el pedido está sujeto a disponibilidad de stock!');
    }
}
