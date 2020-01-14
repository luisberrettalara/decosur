<?php

namespace App\Models\Productos;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
	protected $table = 'productos';
  protected $fillable = [
      'categoria_id', 'nombre', 'precio', 'descripcion', 'fecha', 'imagen', 'codigo'
  ];

  public function categoria() {
    return $this->belongsTo('App\Models\Productos\Categoria');
  }

  public function scopeCategoria($query, $filtro) {
    if(array_key_exists('categoria_id', $filtro)) {
      return $query->where('categoria_id', $filtro['categoria_id']);
    }
  }

  public function getNombreCorto() {
    $nombre = html_entity_decode(strip_tags($this->nombre));
    if (strlen($nombre) > 23) {
      $nombre = mb_substr($nombre, 0, 23, "utf-8") . '...';
    }
    return $nombre;
  }

  public function getDescripcionCorta() {
    $descripcion = html_entity_decode(strip_tags($this->descripcion));
    if (strlen($descripcion) > 26) {
      $descripcion = mb_substr($descripcion, 0, 26, "utf-8") . '...';
    }
    return $descripcion;
  }
}
