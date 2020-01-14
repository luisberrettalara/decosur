<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';

    protected $fillable = ['nombre'];

    public function esAdministrador() {
      return $this->nombre === 'Administrador';
    }

    public function __toString() {
      return $this->nombre;
    }
}
