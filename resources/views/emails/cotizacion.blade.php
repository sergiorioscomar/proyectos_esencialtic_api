@component('mail::message')
# ¡Hola {{ $user->name }}!

Te enviamos la cotización del servicio **{{ $service->title }}**.

@component('mail::panel')
- Categoría: {{ $service->category ?? 'Sin categoría' }}
- Precio estimado: ${{ number_format($price, 2, ',', '.') }}
@endcomponent

@if($mensaje)
{{ $mensaje }}
@else
Este es un presupuesto estimado del servicio.
Para poder ofrecerle una cotización más precisa y ajustada a sus necesidades, necesitamos conocer algunos detalles adicionales.

Si desea, puede comentarnos un poco más sobre lo que está buscando y con gusto le enviaremos una cotización personalizada y detallada.
@endif

Gracias por confiar en nosotros.<br>
{{ config('app.name') }}
@endcomponent