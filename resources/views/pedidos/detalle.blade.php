@extends(Auth::user() && Auth::user()->esAdmin() ? 'layouts.admin' : 'layouts.app')
@section('content')
<div class="py-3">
  <form action="{{ route('pedido.confirmar') }}" method="POST" role="form" class="form-pedido">
    <h1 class="text-center">Detalle de tu reserva</h1>
    <div class="card">
      <div class="card-body">
        <h3 class="text-center">Datos del usuario</h3>
        <table class="table table-striped">
          <tr><td>Nombre</td><td>{{ Auth::user()->nombre }}</td></tr>
          <tr><td>Email</td><td>{{ Auth::user()->email }}</td></tr>
          <tr><td>Teléfono</td><td>{{ Auth::user()->telefono }}</td></tr>
          <tr><td>Domicilio</td><td>{{ Auth::user()->domicilio }}</td></tr>
        </table>
        <hr>
        <h3 class="text-center">Datos del pedido</h3>
        <table class="table table-striped">
          <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
          </tr>
          @foreach($pedido as $item)
            <tr>
              <td>{{$item->nombre}}</td>
              <td>{{$item->precio}}</td>
              <td>{{$item->cantidad}}</td>
              <td>$ {{ number_format($item->precio * $item->cantidad, 2) }}</td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
    <hr>
    <h2 class="text-center"><span class="badge badge-pill badge-success">Total: ${{ number_format($total, 2) }}</span></h2>
    <hr>
    <div class="row justify-content-center">
      <div class="col-md-2 col-6 text-center">
        <a href="{{ route('pedido.show', $item->id) }}" class="btn btn-outline-dark">Regresar</a>
      </div>
      <div class="col-md-2 col-6 text-center">
        <button type="submit" class="btn btn-azul btn-modal-pedido">Confirmar la reserva</button>
      </div>
    </div>
  </form>
</div>
<div class="modal fade" id="modal-pedido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-12 text-center">
            <p>Tu reserva se ha realizado con éxito, recordá que el pedido está sujeto a disponibilidad de stock!</p>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-center">
            <a href="/" class="btn btn-azul">Regresar al inicio</a>
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
      $('.form-pedido').on('submit', function(e) {
        e.preventDefault();
        $('#modal-pedido').modal();
        $.post($(this).attr('action'), $(this).serialize(), function(response) {
          if(response.url) {
            window.open(response.url, '_blank');
          }
        });
      });
    });
  </script>
@endsection
