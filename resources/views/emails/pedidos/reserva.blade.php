@component('mail::message')
# Nueva reserva de productos

@component('mail::panel')

# Usuario
## Nombre/Razón social: {{ $usuario->nombre }}
## E-mail: [{{ $usuario->email }}](mailto:{{ $usuario->email }})
## Teléfono: {{ $usuario->telefono }}
## Domicilio: {{ $usuario->domicilio }}
<br>
# Detalle de la reserva
@foreach($carrito as $carr)
  ## Nombre: {{ $carr->nombre }}
  ## Descripción: {{ $carr->descripcion }}
  ## Precio: {{ $carr->precio }}
  ## Cantidad: {{ $carr->cantidad }}
  ## Subtotal: ${{ number_format($carr->precio * $carr->cantidad, 2)  }}
  <hr>
@endforeach
## Total: ${{ number_format($total, 2) }}
@endcomponent
@endcomponent