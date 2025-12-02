<?php

namespace App\Http\Controllers;

use App\Models\Service;

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
                    ];
                });
            })
            ->values();

        return response()->json($hires);
    }
}
