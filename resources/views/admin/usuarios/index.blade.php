@extends('layouts.admin')
@section('content')
<div class="py-4">
  @if(session('exito'))
    <div class="alert alert-success" role="alert"> 
      {{session('exito')}}
    </div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger" role="alert"> 
      {{session('error')}}
    </div>
  @endif
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 col-12">
              <h3>Lista de usuarios</h3>
            </div>
            <div class="col-md-6 col-12 text-md-right">
              <a href="{{route('admin.usuarios.create')}}" class="btn btn-azul">Añadir nuevo usuario</a>
            </div>
          </div>
          <div class="table-container">
            <table class="table table-striped">
              <thead>
                <tr>
                  <td>NOMBRE</td>
                  <td>EMAIL</td>
                  <td>DOMICILIO</td>
                  <td>TELEFONO</td>
                  <td>CUIT</td>
                  <td>ROL</td>
                  <td width="150px">ACCIONES</td>
                </tr>
              </thead>
              <tbody>
                @forelse($usuarios as $usuario)
                  <tr>
                    <td>{{$usuario->nombre}}</td>
                    <td>{{$usuario->email}}</td>
                    <td>{{$usuario->domicilio}}</td>
                    <td>{{$usuario->telefono}}</td>
                    <td>{{$usuario->cuit}}</td>
                    <td>{{$usuario->rol->nombre}}</td>
                    <td>
                      <form action="{{ route('admin.usuarios.destroy', $usuario->id)}}" class="btn-group form-eliminar" method="post">
                      <a href="{{ route('admin.usuarios.edit',$usuario->id)}}" class="btn btn-primary btn-sm" title="Editar"><i class="fas fa-pencil-alt fa-sm"></i></a>
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit" title="Eliminar"><i class="fas fa-trash-alt fa-sm"></i></button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="7">Aún no hay registros disponibles</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          {{$usuarios->links('vendor.pagination.default')}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('post-scripts')
  <script type="text/javascript">
    $(function() {
      $('.form-eliminar').on('submit', function() {
        return confirm('Estas seguro que desea eliminar este usuario?');
      })
    });
  </script>
@endsection