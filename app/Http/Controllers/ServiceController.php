<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    // Listar servicios (usuarios autenticados)
    public function index()
    {
        return response()->json(Service::all());
    }

    // Mostrar un servicio
    public function show($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['error' => 'Servicio no encontrado'], 404);
        }

        return response()->json($service);
    }

    // Crear servicio (solo admin)
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
            'category' => 'nullable|string|max:100',
            'price' => 'required|numeric',
        ]);

        $service = Service::create($data);

        return response()->json($service, 201);
    }

    // Actualizar servicio (solo admin)
    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['error' => 'Servicio no encontrado'], 404);
        }

        $data = $request->validate([
            'title' => 'sometimes|required|string',
            'description' => 'sometimes|nullable|string',
            'image_url' => 'sometimes|nullable|url',
            'category' => 'sometimes|nullable|string|max:100',
            'price' => 'sometimes|required|numeric',
        ]);

        $service->update($data);

        return response()->json($service);
    }

    // Eliminar servicio (solo admin)
    public function destroy($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['error' => 'Servicio no encontrado'], 404);
        }

        $service->delete();

        return response()->json(['message' => 'Servicio eliminado']);
    }

    public function hire(Request $request, $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['error' => 'Servicio no encontrado'], 404);
        }

        $user = $request->user();

        $existing = $user->services()->where('service_id', $id)->first();

        if ($existing) {
            if ($existing->pivot->quote_status === 'sin_cotizar') {
                return response()->json(['error' => 'Ya existe una cotización pendiente'], 409);
            }

            $user->services()->updateExistingPivot($id, [
                'quote_status' => 'sin_cotizar',
                'quote_sent_at' => null,
                'updated_at' => now(),
            ]);

            return response()->json(['message' => 'Se solicitó nuevamente la cotización']);
        }

        $user->services()->attach($id, ['quote_status' => 'sin_cotizar']);

        return response()->json(['message' => 'Cotización solicitada']);
    }
}
