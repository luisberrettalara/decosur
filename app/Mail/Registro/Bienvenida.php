<?php

namespace App\Mail\Registro;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Usuarios\User;

class Bienvenida extends Mailable
{
    use Queueable, SerializesModels;

    private $usuario;
    private $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $usuario, $password)
    {
        $this->usuario = $usuario;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'))
                    ->markdown('emails.registro.bienvenida')
                    ->subject('Bienvenido a Decosur')
                    ->with('usuario', $this->usuario)
                    ->with('password', $this->password);
    }
}
