<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\Productos\Categoria;
use App\Models\Productos\Producto;
use Auth;

class ProductosController extends Controller
{

    private function rules() {
        return [
            'categoria_id' => 'required',
            'nombre' => 'required|string',
            'precio' => 'required',
            'descripcion' => 'required|string|max:200',
            'imagen' => 'required|image',
            'codigo' => 'required|string'
        ];
    }

    private function messages() {
        return [
            'categoria_id.required' => 'Debe seleccionar una categoría',
            'nombre.required' => 'Debe ingresar el nombre del producto',
            'precio.required' => 'Debe ingresar el precio del producto',
            'descripcion.required' => 'Debe ingresar la descripción del producto',
            'domicilio.max' => 'La descripcion no puede tener más de 200 caracteres',
            'imagen.required' => 'Debe ingresar una imagen',
            'imagen.image' => 'Debe ingresar un formato de imágen válido',
            'codigo.required' => 'Debe ingresar el código del producto'
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
        $productos = Producto::orderBy('created_at', 'desc')->paginate(50);
        return view('admin.productos.index')->with('productos', $productos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.productos.create')->with('categorias', Categoria::orderBy('nombre')->get());
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
            $fileName = '';
            if($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $path = public_path() . '/images/';
                $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($path, $fileName);
                $fileName = '/images/'. $fileName;
            }
            $producto = new Producto($request->except('precio'));
            $producto->precio = (float) str_replace(',', '.', $request->input('precio'));
            $producto->categoria()->associate($request->input('categoria_id'));
            $producto->imagen = $fileName;

            $producto->save();
            $producto->slug = $producto->id . '/' . str_slug($producto->nombre, '-');
            $producto->save();
            return redirect()->route('admin.productos.index')->with('exito', 'Producto creado con éxito');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $slug)
    {   
        $producto = Producto::where('id', $id)
                            ->orWhere('slug', $slug)
                            ->firstOrFail();

        return view('productos.show')->with('producto', $producto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('admin.productos.edit')->with('producto', $producto)
                                           ->with('categorias', Categoria::orderBy('nombre')->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $request->validate(['categoria_id' => 'required',
            'nombre' => 'required|string',
            'precio' => 'required',
            'descripcion' => 'required|string|max:200',
            'codigo' => 'required'
            ], ['categoria_id.required' => 'Debe seleccionar una categoría',
            'nombre.required' => 'Debe ingresar el nombre del producto',
            'precio.required' => 'Debe ingresar el precio del producto',
            'descripcion.required' => 'Debe ingresar la descripción del producto',
            'domicilio.max' => 'La descripción no puede tener más de 200 caracteres',
            'codigo.required' => 'Debe ingresar el código del producto']);
            $producto->update($request->except('precio'));
            $producto->precio = (float) str_replace(',', '.', $request->input('precio'));
            if($request->hasFile('imagen')) {
                if (File::exists(public_path($producto->imagen))) {
                    File::delete(public_path($producto->imagen));
                }
                $fileName = '';
                $file = $request->file('imagen');
                $path = public_path() . '/images/';
                $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($path, $fileName);
                $fileName = '/images/'. $fileName;
                $producto->imagen = $fileName;
            }

            //Si cambia la categoría
            if ($producto->categoria->id != $request->get('categoria_id')) {
              $producto->categoria()->dissociate();
              $producto->categoria()->associate($request->input('categoria_id'));
            }
            $producto->slug = $producto->id . '/' . str_slug($producto->nombre, '-');
            $producto->save();
            return redirect()->route('admin.productos.index')->with('exito', 'El producto ha sido actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        if (File::exists(public_path($producto->imagen))) {
            File::delete(public_path($producto->imagen));
        }
        $producto->delete();
        return redirect()->route('admin.productos.index')->with('exito', 'El producto ha sido eliminado');
    }
}
