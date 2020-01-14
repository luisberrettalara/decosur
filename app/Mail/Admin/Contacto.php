<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contacto extends Mailable
{
    use Queueable, SerializesModels;

    private $nombre;
    private $email;
    private $mensaje;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nombre, $email, $mensaje) {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->from($this->email)
                    ->subject('Nuevo mensaje de contacto en Decosur')
                    ->markdown('emails.admin.contacto')
                    ->with('nombre', $this->nombre)
                    ->with('email', $this->email)
                    ->with('mensaje', $this->mensaje);
    }
}
