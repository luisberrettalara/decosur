<?php

namespace App\Models\Productos;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
	protected $table = 'categorias';

  protected $fillable = ['nombre'];

  public function getPrimerCaracterNombre() {
    return substr($this->nombre, 0, 1);
  }
}