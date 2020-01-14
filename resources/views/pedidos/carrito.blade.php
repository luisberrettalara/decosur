@extends(Auth::user() && Auth::user()->esAdmin() ? 'layouts.admin' : 'layouts.app')
@section('content')
<div class="py-3">
  @if(count($pedido))
    <h1 class="text-center"><i class="fas fa-shopping-cart"></i> Carrito de Reservas</h1>
    <div class="row">
      <div class="col-12 text-center">
        <a class="btn btn-danger" href="{{ route('pedido.trash') }}">
          Vaciar Carrito <i class="fas fa-trash"></i>
        </a>
      </div>
    </div>
    <div class="card mt-3">
      <div class="card-body">
        <div class="table-container">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Imágen</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio Unitario</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th>Quitar</th>
              </tr>
            </thead>
            <tbody>
              @foreach($pedido as $item)
                <tr>
                  <td><img src="{{ $item->imagen }}"></td>
                  <td>{{ $item->nombre }}</td>
                  <td>{{ $item->categoria->nombre }}</td>
                  <td>${{number_format($item->precio,2)}}</td>
                  <td width="25%">
                    <input type="number" min="1" max="10000" value="{{ $item->cantidad }}" id="producto_{{ $item->id }}" class="input-cantidad" />
                    <input type="hidden" class="input-update-item" data-href="{{ route('pedido.update', $item->id) }}" data-id="{{ $item->id }}">
                  </td>
                  <td>$ {{ number_format($item->precio * $item->cantidad, 2) }}</td>
                  <td>
                    <a href="{{ route('pedido.delete', $item->id) }}" class="btn btn-danger">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <hr>
    <h2 class="text-center"> <span class="badge badge-pill badge-success">Total: ${{ number_format($total, 2) }}</span></h2>
    <hr>
    <div class="row justify-content-center">
      <div class="col-md-2 col-6 text-center">
        <a href="{{ route('home') }}" class="btn btn-outline-dark">Seguir Reservando</a>
      </div>
      <div class="col-md-2 col-6 text-center">
        <a href="{{ route('pedido.detalle') }}" class="btn btn-azul">Continuar</a>
      </div>
    </div>
    @else
    <div class="row">
      <div class="col-12 text-center">
        <div class="card">
          <div class="card-body">
            <h3 class="mt-3">Tu carrito está vacío</h3>
            <span class="form-text text-muted my-4">¿Todavía no sabés qué comprar? ¡Muchos productos te esperan!</span>
          </div>
        </div>
      </div>
    </div>
  @endif
</div>
@endsection
@section('post-scripts')
<script type="text/javascript">
  $(function() {
    $('.input-cantidad').on('change keyup paste', function(e) {
      e.preventDefault();
      var id = $(this).siblings('.input-update-item').data('id');
      var href = $(this).siblings('.input-update-item').data('href');
      var cantidad = $('#producto_' + id).val();
      if ($(this).val() == 0) {
        $(this).val() = 1;
      }
      window.location.href = href + "/" + cantidad;
    });
  });
</script>
@endsection