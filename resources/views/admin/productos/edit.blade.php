@extends('layouts.admin')
@section('content')
<div class="row justify-content-center py-4">
  <div class="col-md-8 col-12">
    <h4>Modificación de Producto</h4>
    <div class="card">
      <div class="card-body">
        <form method="post" action="{{ route('admin.productos.update', $producto->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
					<div class="form-group">
						<label for="nombre"><strong>Nombre del Producto</strong></label>
						<input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre', $producto->nombre) }}" autofocus>
            @if ($errors->has('nombre'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('nombre') }}</strong>
              </span>
            @endif
					</div>
          <div class="form-group">
            <label for="codigo"><strong>Código del producto</strong></label>
            <input type="text" class="form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }}" name="codigo" value="{{ old('codigo', $producto->codigo) }}" autofocus>
            @if ($errors->has('codigo'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('codigo') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group">
            <label for="categoria_id"><strong>Categoría del Producto</strong></label>
            <select id="categoria_id" type="text" class="form-control{{ $errors->has('categoria_id') ? ' is-invalid' : '' }}" name="categoria_id" value="{{ old('categoria_id') }}"> 
              <option value="" disabled selected>Seleccione</option>
              @foreach ($categorias as $categoria) 
                <option value="{{$categoria->id}}" {{old('categoria_id', $producto->categoria_id) == $categoria->id? 'selected':''}}>{{$categoria->nombre}}</option> 
              @endforeach
            </select>
            @if ($errors->has('categoria_id'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('categoria_id') }}</strong>
              </span>
            @endif
          </div>
					<div class="form-group">
						<label for="precio"><strong>Precio</strong></label>
						<input type="text" class="form-control{{ $errors->has('precio') ? ' is-invalid' : '' }}" name="precio" value="{{ old('precio', $producto->precio) }}" autofocus>
            @if ($errors->has('precio'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('precio') }}</strong>
              </span>
            @endif
					</div>
					<div class="form-group">
						<label for="descripcion"><strong>Descripción</strong></label>
						<input type="text" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" value="{{ old('descripcion', $producto->descripcion) }}" autofocus>
            @if ($errors->has('descripcion'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('descripcion') }}</strong>
              </span>
            @endif
					</div>
					<div class="row">
            <div class="col-md-9 col-12">
              <div class="form-group">
                <label for="imagen"><strong>Imágen</strong></label>
                <div class="input-group">
                  <input id="imagen" type="file" name="imagen" value="{{ old('imagen', $producto->imagen) }}" autofocus>
                </div>
                @if($errors->has('imagen'))
                <span class="invalid-feedback d-block" role="alert">
                  <strong>{{$errors->first('imagen')}}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="col-md-3 col-12">
              @if($producto->imagen)
                <img src="{{$producto->imagen}}" height="100px" width="100px">
              @endif
            </div>
          </div>
					<div class="row mt-2 mb-0">
            <div class="col-md-2 offset-md-8 col-12 text-md-right">
              <a href="{{route('admin.productos.index')}}" class="btn btn-link btn-block">Volver</a>
            </div>
            <div class="col-md-2 col-12 text-md-right">
              <button type="submit" class="btn btn-azul btn-block">Guardar</button>
            </div>
          </div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection