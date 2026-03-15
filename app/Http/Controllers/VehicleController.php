<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    // Показать форму управления своей машиной
    public function index()
    {
        $vehicle = Auth::user()->vehicle; // Предполагаем связь 1 к 1
        return view('vehicles.my-vehicle', compact('vehicle'));
    }

    // Сохранить или обновить данные машины
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'body_type' => 'required|string',
            'max_weight' => 'required|numeric',
            'length' => 'required|numeric',
            'current_location' => 'nullable|string',
            'is_available' => 'boolean',
        ]);

        $validated['is_available'] = $request->has('is_available');

        Auth::user()->vehicle()->updateOrCreate(
            ['user_id' => Auth::id()],
            $validated
        );

        return back()->with('status', 'Статус и данные машины обновлены!');
    }

    public function allVehicles(Request $request)
    {
        $query = Vehicle::with('user')->where('is_available', true);

        // Фильтр по городу (локации)
        if ($request->filled('city')) {
            $query->where('current_location', 'like', '%' . $request->city . '%');
        }

        $vehicles = $query->latest()->paginate(12)->withQueryString();

        return view('vehicles.index', compact('vehicles'));
    }
}
