@extends(!Auth::user() || !Auth::user()->esAdmin() ? 'layouts.app' : 'layouts.admin', ['container' => false])
@section('content')
<div id="conocenos" class="py-5">
  <div class="container">
    <h2 class="text-center">LA EMPRESA</h2>
    <hr>
    <div class="row justify-content-center">
      <div class="col-md-10 col-12 text-center">
        <p>Decosur nació en 2005 buscando proveer a negocios y emprendimientos locales y del interior del país con las últimas tendencias, como a su vez productos básicos, en los rubros de decoración, bazar, eventos, regalería y artículos de temporada.
        Nuestro objetivo es estar siempre a la vanguardia con nuestra mercadería, como así tambien brindarle la mejor atención y asesoramiento a nuestros clientes.</p>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col-md-4 col-12">
        <div class="card celeste">
          <div class="card-body">
            <div class="circulos">
              <i class="fas fa-globe-americas fa-6x"></i>
            </div>
            <h4 class="text-center mt-4">Misión</h4>
            <span>Ser una empresa líder de decoración mayorista de Córdoba y reconocida en el mercado del interior de Argentina, destacandonos por nuestra buena atención, variedad e innovación de productos.</span>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-12">
        <div class="card verde">
          <div class="card-body">
            <div class="circulos">
              <i class="fas fa-eye fa-6x"></i>
            </div>
            <h4 class="text-center mt-4">Visión</h4>
            <span>Brindar a nuestros clientes la mejor atención y asesoramiento para poder darles la oportunidad de crecer junto a nosotros, transformando así su emprendimiento y negocio en una fuente permanente de ingresos y reconocimiento.</span>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-12">
        <div class="card naranja">
          <div class="card-body">
            <div class="circulos">
              <i class="fas fa-handshake fa-6x"></i>
            </div>
            <h4 class="text-center mt-4">Valores</h4>
              <span> > Vinculos humanos</span>
              <br>
              <span> > Cercanía y compromiso con nuestros clientes</span>
              <br>
              <span> > Buena atención</span>
              <br>
              <span> > Diversidad</span>
              <br>
              <span> > Integridad</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection