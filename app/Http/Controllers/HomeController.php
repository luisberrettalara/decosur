<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Productos\Producto;
use App\Models\Productos\Categoria;
use Session;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $filtro = $request->all();
        $categoriaFiltro = array_key_exists('categoria_id', $filtro) ? Categoria::find($filtro['categoria_id']) : null;
        $productos = array_key_exists('categoria_id', $filtro) ? Producto::orderBy('nombre')->categoria($filtro)->paginate(2)->appends(request()->query()) : Producto::orderBy('updated_at', 'desc')->paginate(2);
        return view('home')->with('productos', $productos)
                           ->with('categorias', Categoria::orderBy('nombre')->get())
                           ->with('categoria_filtro', $categoriaFiltro);
    }

    public function linksBusquedaPorCategoriaFooter() {
        $categoriaBazar = Categoria::where('nombre', 'Bazar')->firstOrFail();
        $categoriaDecoracion = Categoria::where('nombre', 'Decoración')->firstOrFail();
        $categoriaEventos = Categoria::where('nombre', 'Eventos')->firstOrFail();
        $categoriaTextil = Categoria::where('nombre', 'Textil')->firstOrFail();
        $categoriaOtros = Categoria::where('nombre', 'Otros')->firstOrFail();
        $categoriaRegaleria = Categoria::where('nombre', 'Regalería')->firstOrFail();
        $categoriaFlores = Categoria::where('nombre', 'Flores')->firstOrFail();
        $urlBase = '/?categoria_id=';
        $url = [
            $categoriaBazar->nombre => $urlBase . $categoriaBazar->id . '/#nuestros-productos',
            $categoriaDecoracion->nombre => $urlBase . $categoriaDecoracion->id . '/#nuestros-productos',
            $categoriaEventos->nombre => $urlBase . $categoriaEventos->id . '/#nuestros-productos',
            $categoriaFlores->nombre => $urlBase . $categoriaFlores->id . '/#nuestros-productos',
            $categoriaRegaleria->nombre => $urlBase . $categoriaRegaleria->id . '/#nuestros-productos',
            $categoriaTextil->nombre => $urlBase . $categoriaTextil->id . '/#nuestros-productos',
            $categoriaOtros->nombre => $urlBase . $categoriaOtros->id . '/#nuestros-productos',
        ];

    return $url;
    }
}
