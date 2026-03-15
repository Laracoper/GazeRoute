<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CargoController extends Controller
{
    // Список всех грузов (доступно всем)
    // app/Http/Controllers/CargoController.php
    public function index(Request $request)
    {
        $query = Cargo::with('user')->latest();

        // Фильтр "Откуда"
        if ($request->filled('from')) {
            $query->where('route_from', 'like', '%' . $request->from . '%');
        }

        // Фильтр "Куда"
        if ($request->filled('to')) {
            $query->where('route_to', 'like', '%' . $request->to . '%');
        }

        $cargos = $query->paginate(12)->withQueryString(); // withQueryString сохраняет фильтры при переходе по страницам

        return view('cargos.index', compact('cargos'));
    }



    // Форма создания (только для авторизованных)
    public function create()
    {
        return view('cargos.create');
    }

    // Сохранение груза (только для авторизованных)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'route_from' => 'required|string|max:100',
            'route_to' => 'required|string|max:100',
            // min:0.1 — нельзя 0 или минус, max:2 — не больше 2 тонн
            'weight' => 'required|numeric|min:0.1|max:2',
            // max:20 — с запасом на высокий тент
            'volume' => 'required|numeric|min:1|max:20',
            // Цена от 500 руб до 500к
            'price' => 'nullable|integer|min:500|max:500000',
            'description' => 'nullable|string|max:500',
        ]);

        Auth::user()->cargos()->create($validated);

        return redirect()->route('cargos.index')->with('success', 'Груз опубликован!');
    }


    public function destroy(Cargo $cargo)
    {
        // Проверяем, что удаляет именно владелец
        if (Auth::id() !== $cargo->user_id) {
            abort(403);
        }

        $cargo->delete();

        return back()->with('success', 'Груз успешно удален');
    }
}
