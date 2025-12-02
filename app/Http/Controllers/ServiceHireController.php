<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceHireController extends Controller
{
    public function index()
    {
        $hires = Service::with(['users:id,name,email'])
            ->get()
            ->flatMap(function ($service) {
                return $service->users->map(function ($user) use ($service) {
                    return [
                        'service_id' => $service->id,
                        'service_title' => $service->title,
                        'service_category' => $service->category,
                        'service_price' => $service->price,
                        'user_id' => $user->id,
                        'user_name' => $user->name,
                        'user_email' => $user->email,
                        'hired_at' => $user->pivot->created_at,
                        'quote_status' => $user->pivot->quote_status,
                        'quote_sent_at' => $user->pivot->quote_sent_at,
                    ];
                });
            })
            ->values();

        return response()->json($hires);
    }

    public function updateStatus(Request $request, $serviceId, $userId)
    {
        $data = $request->validate([
            'quote_status' => 'required|in:sin_cotizar,cotizada',
        ]);

        $service = Service::findOrFail($serviceId);

        if (!$service->users()->where('user_id', $userId)->exists()) {
            return response()->json(['message' => 'Contratación no encontrada'], 404);
        }

        $service->users()->updateExistingPivot($userId, [
            'quote_status' => $data['quote_status'],
            'quote_sent_at' => $data['quote_status'] === 'cotizada' ? now() : null,
        ]);

        return response()->json(['message' => 'Estado actualizado correctamente']);
    }

    public function destroy($serviceId, $userId)
    {
        $service = Service::findOrFail($serviceId);

        if (!$service->users()->where('user_id', $userId)->exists()) {
            return response()->json(['message' => 'Contratación no encontrada'], 404);
        }

        $service->users()->detach($userId);

        return response()->json(['message' => 'Contratación eliminada']);
    }
}
