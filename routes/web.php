<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => 'admin', 'namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
  Route::resource('usuarios', 'UsuariosController');
  Route::get('productos/{id}/edit', 'ProductosController@edit');
  Route::get('productos/{id}/{slug}', 'ProductosController@show');
  Route::resource('productos', 'ProductosController');
});

Route::get('/contacto', function() {
  return view('contacto');
});

Route::get('/conocenos', function() {
  return view('conocenos');
});

Route::get('/', 'HomeController@index')->name('home');

Route::post('/contactar', 'ContactoController@contactar')->name('admin.contactar');

Route::get('productos/{id}/{slug}', 'ProductosController@show');

Route::resource('productos', 'ProductosController')->only(['show']);

Route::get('pedido/show', 'PedidosController@show')->name('pedido.show');

Route::get('pedido/add/{producto}', 'PedidosController@add')->name('pedido.add');

Route::get('pedido/delete/{producto}', 'PedidosController@delete')->name('pedido.delete');

Route::get('pedido/trash', 'PedidosController@trash')->name('pedido.trash');

Route::get('pedido/update/{producto}/{cantidad?}', 'PedidosController@update')->name('pedido.update');

Route::get('detalle-pedido', 'PedidosController@detallePedido')->name('pedido.detalle');

Route::post('pedido/confirmar', 'PedidosController@store')->name('pedido.confirmar');

Route::get('usuario/editar-contraseña', 'UsuariosController@edit')->name('usuarios.edit');

Route::patch('usuario/{usuario}/update', 'UsuariosController@update')->name('usuarios.update');