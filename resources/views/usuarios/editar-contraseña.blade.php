@extends('layouts.app')
@section('content')
<div class="row justify-content-center py-4">
  <div class="col-md-7 col-12">
    <h3>Cambiar contraseña</h3>
      <div class="card">
        <div class="card-body">
          <form method="POST" action="{{ route('usuarios.update', Auth::id()) }}">
            @csrf
            @method('PATCH')
          <div class="form-group">
            <label for="password">Nueva Contraseña</label>
            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group">
            <label for="password-confirm">Confirmar Nueva Contraseña</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
          </div>
          <div class="row mb-0">
            <div class="col-md-2 offset-md-8 col-12 text-md-right">
                <a href="{{route('home')}}" class="btn btn-link btn-block">Volver</a>
            </div>
            <div class="col-md-2 col-12 text-md-right">
              <button type="submit" class="btn btn-azul btn-block">
                Guardar
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection