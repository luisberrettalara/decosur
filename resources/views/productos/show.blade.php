@extends(Auth::user() && Auth::user()->esAdmin() ? 'layouts.admin' : 'layouts.app')
@section('title')
{{ $producto->getNombreCorto() . ' - ' . config('app.name', 'La Nueva') }}
@endsection

@section('content')
  <div class="row justify-content-center py-4 detalle-producto">
    <div class="col-12">
      <h3>{{$producto->nombre}}</h3>
      <div class="row">
        <div class="col-md-6 col-12">
         <img src="{{ $producto->imagen }}">
        </div>
        <div class="col-md-6 col-12 mt-3">
          @if(Auth::user())
            <small>Precio</small>
            <h4>$ <strong>{{ number_format($producto->precio,2) }}</strong></h4>
            @if(!Auth::user()->esAdmin())
              <div class="row">
                <div class="col-md-6 col-12">
                  <a href="{{ route('pedido.add', $producto->id) }}" class="btn btn-azul mt-5 mb-4">Agregar al carro <i class="fa fa-shopping-cart"></i></a>
                </div>
              </div>
            @endif
          @endif
          <p> {{$producto->descripcion}} </p>
          <p>Código: <strong>{{ $producto->codigo }}</strong></p>
          <div class="alert alert-primary mt-3 d-none alert-dismissible fade show" role="alert">
            El producto ha sido agregado al carro!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      </div>
      <a href="{{ app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName() == 'admin.productos.index' ? route('admin.productos.index') : route('home') }}" class="btn btn-outline-dark mt-3">Regresar</a>
    </div>
  </div>
@endsection
@section('post-scripts')
<script type="text/javascript">
  $(function() {
    $('.btn-azul').click(function() {
      var url = $(this).attr('href');
      $(this).parents('.detalle-producto').find('.alert').removeClass('d-none');
      $.get(url, function(e) {
        return false;
      });
      return false;
    });
  });
</script>
@endsection