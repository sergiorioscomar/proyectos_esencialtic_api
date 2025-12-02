<?php

namespace App\Http\Controllers;

use App\Mail\CotizacionMail;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CotizacionController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'price' => 'required|numeric|min:0',
            'mensaje' => 'nullable|string',
        ]);

        $user = User::findOrFail($data['user_id']);
        $service = Service::findOrFail($data['service_id']);

        if (!$user->services()->where('service_id', $service->id)->exists()) {
            return response()->json([
                'message' => 'El usuario todavía no contrató este servicio',
            ], 422);
        }

        Mail::to($user->email)->send(
            new CotizacionMail($user, $service, (float) $data['price'], $data['mensaje'] ?? null)
        );

        $user->services()->updateExistingPivot($service->id, [
            'quote_status' => 'cotizada',
            'quote_sent_at' => now(),
        ]);

        return response()->json([
            'message' => 'Cotización enviada correctamente',
        ]);
    }
}
