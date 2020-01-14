<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios\User;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function edit() {
      return view('usuarios.editar-contraseña');
    }

    public function update(User $usuario, Request $request) {
      $request->validate(['password' => 'required|string|min:6|confirmed'], 
        ['password.required' => 'Ingrese una contraseña', 
        'password.min' => 'La contraseña debe tener al menos 6 caracteres',
        'password.confirmed' => 'Las contraseñas no coinciden']);
      $usuario->password = Hash::make($request->input('password'));
      $usuario->save();
      return redirect()->route('home')->with('message', 'Contraseña cambiada con éxito');
    }
}
