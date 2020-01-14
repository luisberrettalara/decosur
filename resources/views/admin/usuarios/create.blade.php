@extends('layouts.admin')
@section('content')
<div class="row justify-content-center py-4">
  <div class="col-md-8 col-12">
    <h4>Alta de usuario</h4>
    <div class="card">
      <div class="card-body">
        <form method="POST" action="{{ route('admin.usuarios.store') }}">
        @csrf
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" autofocus>
            @if ($errors->has('nombre'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('nombre') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">
            @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group">
            <label for="domicilio">Domicilio</label>
            <input type="domicilio" class="form-control{{ $errors->has('domicilio') ? ' is-invalid' : '' }}" name="domicilio" value="{{ old('domicilio') }}">
            @if ($errors->has('domicilio'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('domicilio') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="telefono" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="{{ old('telefono') }}">
            @if ($errors->has('telefono'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('telefono') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group">
            <label for="cuit">CUIT/CUIL</label>
            <input type="cuit" class="form-control{{ $errors->has('cuit') ? ' is-invalid' : '' }}" name="cuit" value="{{ old('cuit') }}">
            @if ($errors->has('cuit'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('cuit') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group">
            <label for="rol_id">Rol</label>
            <select id="rol_id" type="text" class="form-control{{ $errors->has('rol_id') ? ' is-invalid' : '' }}" name="rol_id" value="{{ old('rol_id') }}"> 
              <option value="" disabled selected>Seleccione</option>
              @foreach ($roles as $rol) 
                <option value="{{$rol->id}}" {{old('rol_id') == $rol->id? 'selected':''}}>{{$rol->nombre}}</option> 
              @endforeach
            </select>
            @if ($errors->has('rol_id'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('rol_id') }}</strong>
              </span>
            @endif
          </div>
          <div class="row mb-0">
            <div class="col-md-2 offset-md-8 col-12 text-md-right">
              <a href="{{route('admin.usuarios.index')}}" class="btn btn-link btn-block">Volver</a>
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