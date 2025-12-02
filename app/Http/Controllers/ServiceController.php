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
        $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        $service = Service::create($request->all());

        return response()->json($service, 201);
    }

    // Actualizar servicio (solo admin)
    public function update(Request $request, $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['error' => 'Servicio no encontrado'], 404);
        }

        $service->update($request->all());

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

    public function hire($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['error' => 'Servicio no encontrado'], 404);
        }

        auth()->user()->services()->attach($id);

        return response()->json(['message' => 'Servicio contratado']);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
