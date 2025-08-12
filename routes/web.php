<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ReservationController;
use App\Models\Property;
use App\Models\Reservation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $properties = Property::all();
    return view('welcome', [
        'properties' => $properties,
    ]);
});


Route::get('/dashboard', function () {
    $reservations = Auth::user()->reservations;

    // Fetch properties from reservations
    $properties = new Collection;
    $reservations->each(function (Reservation $reservation) use ($properties) {
        $property = Property::find($reservation->property_id);
        $properties->add($property);
    });

    return view('dashboard', [
        'reservations' => $reservations,
        'properties' => $properties,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/reserve/{id}', [ReservationController::class, 'reserve'])->name('reserve-property');
    Route::get('/reservation/cancel/{id}', [ReservationController::class, 'cancel'])->name('cancel-reservation');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
