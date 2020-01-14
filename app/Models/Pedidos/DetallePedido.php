<?php

namespace App\Models\Pedidos;

use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
  protected $table = 'detalles_pedido';

  public function producto() {
    return $this->belongsTo('App\Models\Productos\Producto');
  }
}
