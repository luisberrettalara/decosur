@extends('layouts.app', ['container' => false])

@section('content')
<div id="login" class="img-fondo">
  <div class="container">
    <div class="row justify-content-center bg-white p-md-4">
      <div class="col-md-6 col-12">
        <div class="row mt-3">
          <div class="col-12 text-center text-md-left">
            <h1>Contactate con nosotros para abrir una cuenta</h1>
            <h5 class="my-3">Tendrás los siguientes beneficios</h5>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <p><i class="fas fa-box-open"></i> &nbsp;Ver nuestro catálogo de productos en detalle</p>
                <p><i class="fas fa-dollar-sign ml-1 mr-2"></i> Conocer nuestros precios</p>
                <p><i class="fas fa-shopping-cart"></i> &nbsp;Reservar tus productos</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-12 mt-5">
        <form method="POST" action="{{ route('login') }}">
        @csrf
        <h5 class="text-center">Iniciar sesión</h5>
          <div class="form-group row">
            <div class="col-12">
              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} input-email" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>
              
              @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
              <span class="icono-input">
                <i class="fa fa-envelope"></i>
              </span>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-12">
              <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} input-password" placeholder="Contraseña" name="password" required>
              @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('password') }}</strong>
                </span>
              @endif
              <span class="icono-input">
                <i class="fas fa-lock"></i>
              </span>
            </div>
          </div>
          <div class="row mb-0">
            <div class="col-md-6 col-12">
              <button type="submit" class="btn btn-primary">
                Iniciar sesión
              </button>
            </div>
            <div class="col-md-6 col-12 text-right">
              @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                  Olvidé mi contraseña
                </a>
              @endif
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection