<?php

namespace App\Livewire;

use App\Models\Property;
use Livewire\Component;

class ReservationModal extends Component
{
    public Property $property;

    public function render()
    {
        return view('livewire.reservation-modal');
    }
}
