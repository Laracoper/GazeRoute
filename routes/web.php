<?php

use App\Http\Controllers\CargoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/my-vehicle', [VehicleController::class, 'index'])->name('vehicles.index');
    Route::post('/my-vehicle', [VehicleController::class, 'store'])->name('vehicles.store');
    Route::delete('/cargos/{cargo}', [CargoController::class, 'destroy'])->name('cargos.destroy');

});

require __DIR__ . '/auth.php';


// Эти маршруты видят ВСЕ (даже без логина)
Route::get('/cargos', [CargoController::class, 'index'])->name('cargos.index');

Route::get('/vehicles', [VehicleController::class, 'allVehicles'])->name('vehicles.all');

Route::get('/vehicles', [VehicleController::class, 'allVehicles'])->name('vehicles.all');



// Эти маршруты только для тех, кто вошел в систему (auth)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/cargos/create', [CargoController::class, 'create'])->name('cargos.create');
    Route::post('/cargos', [CargoController::class, 'store'])->name('cargos.store');
});
