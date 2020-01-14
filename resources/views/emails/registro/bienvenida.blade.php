@component('mail::message')
# Hola {{$usuario->nombre}}. Bienvenido a Decosur!
@component('mail::panel')
## Tu contraseña para ingresar es: <strong>{{ $password }}</strong>, te recomendamos que la cambies al ingresar.
@endcomponent
@endcomponent