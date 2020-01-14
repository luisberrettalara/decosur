<?php

namespace App\Mail\Pedidos;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Usuarios\User;

class Reserva extends Mailable
{
    use Queueable, SerializesModels;

    private $carrito;
    private $usuario;
    private $total;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $usuario, $carrito, $total)
    {
        $this->carrito = $carrito;
        $this->usuario = $usuario;
        $this->total = $total;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($usuario->email)
                    ->markdown('emails.pedidos.reserva')
                    ->subject('Recibiste una reserva del cliente '. $this->usuario->nombre . '(' . $this->usuario->email . ')' )
                    ->with('usuario', $this->usuario)
                    ->with('carrito', $this->carrito)
                    ->with('total', $this->total);
    }
}
