<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class ReservationController extends Controller
{
    private function validateAvailabilityDates(Request $request, Property $property): array
    {
        $available_from = date_create($property->available_from);
        $available_to = date_create($property->available_to);

        $validated = $request->validate([
            'start-date' => 'required|date',
            'end-date' => 'required|date',
        ]);

        $start_date = date_create($request->input('start-date'));
        $end_date = date_create($request->input('end-date'));

        // 1 2 3 4 5 6 7
        // from 2 to 5
        // start = 2
        // end = 4
        if (
            $start_date >= $available_from &&
            $start_date <= $end_date &&
            $end_date <= $available_to
        )
        {
            return [
                'success' => true,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'available_from' => $available_from,
                'available_to' => $available_to,
            ];
        }

        return ['success' => false];
    }

    public function reserve(Request $request, string $id)
    {
        $user = Auth::user();

        $property = Property::where('id', $id);
        if (!$property->exists())
        {
            Log::debug('Property doesn\'t exist');
            return Redirect::back();
        }

        $property = $property->first();
        $validationData = $this->validateAvailabilityDates($request, $property);

        if (!$validationData['success'])
        {
            Log::debug('Availability dates validation failed');
            return Redirect::back();
        }

        $start_date = $validationData['start_date'];
        $end_date = $validationData['end_date'];

        Reservation::create([
            'user_id' => $user->id,
            'property_id' => $property->id,
            'start' => $start_date,
            'end' => $end_date,
        ]);

        $property->update([
            'available' => false,
        ]);

        return Redirect::to('/dashboard');
    }

    public function cancel(Request $request, string $id)
    {
        $user = Auth::user();
        $reservation = Reservation::where('id', $id);

        if (!$reservation->exists())
        {
            Log::debug('Reservation doesnt exist');
            return Redirect::back()->withErrors(['error' => 'Impossible de supprimer la réservation']);
        }

        if ($reservation->first()->user->id !== $user->id)
        {
            Log::debug('User ids not matching');
            return Redirect::back()->withErrors(['error' => 'Impossible de supprimer la réservation']);
        }

        // Very simple method of handling property availability when the reservation is cancelled
        $property = Property::where('id', $reservation->first()->property_id)->first();
        $property->update(['available' => true]);

        $reservation->delete();

        return Redirect::back();
    }
}
