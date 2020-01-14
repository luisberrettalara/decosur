<?php

namespace App\Models\Pedidos;

use Illuminate\Database\Eloquent\Model;
use App\Models\Productos\Producto;

class Pedido extends Model
{
  protected $table = 'pedidos';
  protected $fillable = [
    'total, usuario_id'
  ];

  public function detalle() {
    return $this->hasMany('App\Models\Pedidos\DetallePedido');
  }

  public function agregarDetalle(Producto $producto, $cantidad, $precioUnitario) {
    $detalle = new DetallePedido;
    $detalle->cantidad = $cantidad;
    $detalle->precio_unitario = $precioUnitario;
    $detalle->producto()->associate($producto);

    // ...y lo agregamos al pedido
    $this->detalle()->save($detalle);
  }
}
