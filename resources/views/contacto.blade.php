@extends(!Auth::user() || !Auth::user()->esAdmin() ? 'layouts.app' : 'layouts.admin', ['container' => false])
@section('content')
<div id="contacto">
  <div class="pt-5 pb-3">
    <div class="container">
      <h2 class="text-center">CONTACTO</h2>
    </div>
  </div>
  <div class="container">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3404.7726898003425!2d-64.18530148422535!3d-31.42038830359093!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9432a29ad4f5b239%3A0xa6e002f8acb433b1!2sDeco+Sur!5e0!3m2!1ses-419!2sar!4v1563318969027!5m2!1ses-419!2sar" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
    <div class="row my-5">
      <div class="col-md-7 col-12">
         <form class="contactar" action="{{route('admin.contactar')}}" method="POST">
            <div class="form-group">
              <label for="nombre">Nombre/Razón social</label>
              <input id="nombre" type="text" name="nombre" class="form-control">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input id="email" type="text" name="email" class="form-control">
            </div>
            <div class="form-group">
              <label for="mensaje">Mensaje</label>
              <textarea id="mensaje" name="mensaje" class="form-control" rows="6"></textarea>
            </div>
              <div class="mt-2 mb-4 recaptcha-footer">
                  <div class="g-recaptcha" data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}"></div>
                  <div class="invalid-feedback"></div>
              </div>
            <button type="submit" class="btn btn-outline-primary">Enviar consulta</button>
          </form>
      </div>
      <div class="col-md-5 col-12 mt-3">
        <h5>Ubicación</h5>
        <p><i class="fas fa-map-marker-alt"></i>&nbsp; Pje. Emilio Huespe 187 Centro, Córdoba</p>
        <hr class="my-4">
        <h5>Vías de contacto directo</h5>
        <p><i class="fas fa-mobile-alt ml-1"></i>&nbsp; Tel: +54 0351 421-4703</p>
        <p><i class="fas fa-envelope"></i>&nbsp; Mail: administracion@decosur.com.ar</p>
        <hr class="my-4">
        <h5>Redes sociales</h5>
        <a href="https://www.facebook.com/decosurdeco/" target="_blank"><i class="fab fa-facebook-square fa-2x"></i></a>
        <a href="https://www.instagram.com/decosurmayorista/" target="_blank" class="ml-3"><i class="fab fa-instagram fa-2x"></i></a>
        <a href="https://api.whatsapp.com/send?phone=543512370070" target="_blank" class="ml-3"><i class="fab fa-whatsapp fa-2x"></i></a>
      </div>
    </div>
  </div>
</div>
@endsection
@section('post-scripts')
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
  $(function() {
   $('.contactar').submit(function (ev) {
      ev.preventDefault();
      let contactar = $(this);
      let submit = $(this).find('button[type=submit]');
      $(submit).html('Enviando...').prop('disabled', true);

      $.post($(this).attr('action'), $(this).serialize(),
        function (data) {
          $(submit).html('Enviado!');
          setTimeout(function() {
            $(submit).prop('disabled', false);
            $(submit).html('Contactar');
            $(contactar).trigger('reset');
          }, 1000 * 4);
        }
      ).fail(function (xhr) {
        let mensajes = '';
        if(xhr.responseJSON.errors) {
          $.each(xhr.responseJSON.errors, function (k, e) {
            console.log(e);
            $.each(e, function (mk, m) {
              mensajes = mensajes.concat('<p>').concat(m).concat('</p>');
            });
          });
        }

        contactar.find('.recaptcha-footer .invalid-feedback').html(mensajes).show();

        $(submit).html('Ha ocurrido un error');

        setTimeout(function() {
          $(submit).prop('disabled', false);
          $(submit).html('Contactar');
        }, 1000 * 4);
      });

      return false;
    });

    $('.recaptcha-footer').hide();

    $('#email, #mensaje').on('change', function() {
        if($('#email').val() !='' && $('#mensaje').val() !='') {
            $('.recaptcha-footer').show();
        }
        else {
            $('.recaptcha-footer').hide();
        }
    });
  });
</script>
@endsection