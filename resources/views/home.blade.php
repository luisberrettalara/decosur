@extends(!Auth::user() || !Auth::user()->esAdmin() ? 'layouts.app' : 'layouts.admin', ['container' => false])
@section('content')
<div class="row justify-content-center home img-fondo">
  @if(session('message'))
  <div class="row">
    <div class="col-12">
      <div class="alert alert-info">
        {{ session('message')}}
      </div>
    </div>
  </div>
  @endif
</div>
<div class="container productos py-5">
  <h3 class="text-md-left text-center">CATEGORIAS</h3>
  <div class="row align-items-center justify-content-center mb-5">
    @foreach($categorias as $categoria)
      <div class="col-md-3 col-6">
        <div class="card card-categoria">
          <div class="card-body text-center">
            <a href="/?categoria_id={{ $categoria->id }}/#nuestros-productos"><h4 class="text-center">{{ $categoria->nombre }}</h4></a>
            <a href="/?categoria_id={{ $categoria->id }}/#nuestros-productos">
              <div class="circulo">
                <h3>{{$categoria->getPrimerCaracterNombre()}}</h3>
              </div>
            </a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  <hr>
  <div id="nuestros-productos">
    @if($productos->count())
      <h3 class="mt-5 mb-2 text-md-left text-center">NUESTROS PRODUCTOS {{ $categoria_filtro? 'DE LA CATEGORIA ' . $categoria_filtro->nombre_mostrar : '' }}</h3>
    	<div class="row">
    	@foreach($productos as $producto)
    		<div class="col-md-3 col-12">
    			<div class="bg-white mt-4">
    				<div class="text-center">
    					<a href="{{ route('productos.show', $producto->slug) }}"><img src="{{$producto->imagen}}"></a>
    				</div>
    				<br>
    				<a href="{{ route('productos.show', $producto->slug) }}"><h5 class="mt-3">{{$producto->getNombreCorto()}}</h5></a>
            <p>Código: <strong>{{ $producto->codigo }}</strong></p>
    				<br>
    				@if(Auth::user())
    					<small>Precio</small>
    					<h4>${{ number_format($producto->precio, 2) }}</h4>
    				@else
      				<p>{{ $producto->getDescripcionCorta() }}</p>
    				@endif
    				@if(Auth::user() && !Auth::user()->esAdmin())
    				<div class="mt-5">
    					<small>Retiro en tienda</small>
    					<a class="btn btn-azul btn-block" href="{{ route('pedido.add', $producto->id) }}">Agregar al carro <i class="fas fa-shopping-cart"></i></a>
    				</div>
    				@endif
            <div class="alert alert-primary mt-3 d-none alert-dismissible fade show" role="alert">
              Se agregó al carro!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
    			</div>
    		</div>
    	@endforeach
    	</div>
    @else
      <div class="row">
        <div class="col-12 text-center">
          <div class="card">
            <div class="card-body">
              @if($categoria_filtro) 
                <span class="form-text text-muted my-4">Todavía no hay productos para la categoría <strong>{{ $categoria_filtro->nombre }}</strong></span>
              @else
               <span class="form-text text-muted my-4">Todavía no hay productos cargados!</span>
              @endif
            </div>
          </div>
        </div>
      </div>
    @endif
    <div class="row mt-5">
      <div class="col-12">
        {{$productos->links() }}
      </div>
    </div>
  </div>

</div>
@endsection
@section('post-scripts')
<script type="text/javascript">
  $(function() {
    $('.btn-azul').click(function() {
    	var url = $(this).attr('href');
      $(this).parents('.bg-white').find('.alert').removeClass('d-none');
    	$.get(url, function(e) {
    		return false;
    	});
    	return false;
    });
  });
</script>
@endsection