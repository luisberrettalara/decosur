@component('mail::message')
# Solicitud de más información

{{$nombre}} quiere ponerse en contacto con Decosur

@component('mail::panel')

## Nombre/Razón social: {{ $nombre }}
## E-mail: [{{ $email }}](mailto:{{ $email }})

{{ $mensaje }}
@endcomponent

@endcomponent
