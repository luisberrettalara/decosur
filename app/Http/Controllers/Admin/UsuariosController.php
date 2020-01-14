<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Usuarios\User;
use App\Models\Usuarios\Rol;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Registro\Bienvenida;

class UsuariosController extends Controller
{

    private function rules() {
        return [
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|unique:users',
            'domicilio' => 'required|string|max:100',
            'telefono' => 'required|string|max:100',
            'cuit' => 'required|string|max:30', 
            'rol_id' => 'required',
        ];
    }

    private function messages() {
        return [
            'nombre.required' => 'Debe ingresar el nombre',
            'nombre.max' => 'El nombre no puede tener más de 100 caracteres',
            'email.unique' => 'Ya existe un usuario con ese email',
            'email.required' => 'Debe ingresar un email',
            'domicilio.required' => 'Debe ingresar su domicilio',
            'domicilio.max' => 'El domicilio no puede tener más de 100 caracteres',
            'telefono.required' => 'Debe ingresar su número de teléfono',
            'telefono.max' => 'El teléfono no puede tener más de 100 caracteres',
            'cuit.required' => 'Debe ingresar su número de cuit',
            'rol_id.required' => 'Seleccione un rol',
        ];
    }

    public function __construct(Request $request) {
      $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::orderBy('nombre')->paginate(10);
        return view('admin.usuarios.index')->with('usuarios', $usuarios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.usuarios.create')->with('roles', Rol::orderBy('nombre')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->validate($this->rules(), $this->messages())) {
            $usuario = new User($request->all());
            $usuario->rol()->associate($request->input('rol_id'));
            $password = str_random(10);
            $usuario->password = Hash::make($password);
            $usuario->save();
            if(!$usuario->esAdmin()) {
                Mail::to($usuario->email)->send(new Bienvenida($usuario, $password));
            }
            return redirect()->route('admin.usuarios.index')->with('exito', 'Usuario creado con éxito');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.edit')->with('usuario', $usuario)
                                          ->with('roles', Rol::orderBy('nombre')->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $usuario, Request $request)
    {   
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:100|unique:users,email,' . $usuario->id,
            'domicilio' => 'required|string|max:100',
            'telefono' => 'required|string|max:100',
            'cuit' => 'required|string|max:30', 
            'rol_id' => 'required',
        ]);
        $usuario->update($request->all());

        //Si cambiamos el rol se actualiza
        if($usuario->rol->id != $request->get('rol_id')) {
            $usuario->rol()->dissociate();
            $usuario->rol()->associate($request->get('rol_id'));
        }

        $usuario->save();
        
        return redirect()->route('admin.usuarios.index')->with('exito', 'Usuario actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return redirect()->route('admin.usuarios.index')->with('exito', 'El usuario ha sido eliminado');
    }

}
