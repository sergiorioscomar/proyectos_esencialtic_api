<?php

namespace App\Mail;

use App\Models\Service;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CotizacionMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public Service $service;
    public float $price;
    public ?string $mensaje;

    public function __construct(User $user, Service $service, float $price, ?string $mensaje = null)
    {
        $this->user = $user;
        $this->service = $service;
        $this->price = $price;
        $this->mensaje = $mensaje;
    }

    public function build()
    {
        return $this->subject('Cotización del servicio ' . $this->service->title)
            ->markdown('emails.cotizacion')
            ->with([
                'user' => $this->user,
                'service' => $this->service,
                'price' => $this->price,
                'mensaje' => $this->mensaje,
            ]);
    }
}
