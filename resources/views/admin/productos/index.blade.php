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
              <h3>Lista de productos</h3>
            </div>
            <div class="col-md-6 col-12 text-md-right">
              <a href="{{route('admin.productos.create')}}" class="btn btn-azul">Añadir nuevo producto</a>
            </div>
          </div>
          <div class="table-container">
            <table class="table table-striped">
              <thead>
                <tr>
                  <td><strong>NOMBRE</strong></td>
                  <td><strong>CODIGO</strong></td>
                  <td><strong>CATEGORIA</strong></td>
                  <td><strong>PRECIO</strong></td>
                  <td><strong>DESCRIPCION</strong></td>
                  <td><strong>FECHA</strong></td>
                  <td><strong>IMAGEN</strong></td>
                  <td width="150px"><strong>ACCIONES</strong></td>
                </tr>
              </thead>
              <tbody>
                @forelse($productos as $producto)
                  <tr>
                    <td>{{$producto->getNombreCorto()}}</td>
                    <td>{{$producto->codigo}}</td>
                    <td>{{$producto->categoria->nombre}}</td>
                    <td>{{$producto->precio}}</td>
                    <td>{{$producto->getDescripcionCorta()}}</td>
                    <td>{{$producto->created_at->format('d/m/Y')}}</td>
                    <td><img src="{{$producto->imagen}}" width="100"></td>
                    <td>
                    <form action="{{ route('admin.productos.destroy', $producto->id)}}" class="btn-group form-eliminar" method="post">
                    <a class="btn btn-primary btn-sm" title="Ver" href="{{ route('admin.productos.show', $producto->slug)}}">
                      <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.productos.edit', $producto->id)}}" class="btn btn-secondary btn-sm" title="Editar"><i class="fas fa-pencil-alt fa-sm"></i></a>
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm" type="submit" title="Eliminar"><i class="fas fa-trash-alt fa-sm"></i></button>
                    </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="8">Aún no hay registros disponibles</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
            {{$productos->links('vendor.pagination.default')}}
          </div>
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
        return confirm('Estás seguro que desea eliminar éste producto?');
      })
    });
  </script>
@endsection