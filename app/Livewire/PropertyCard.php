<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use App\Models\Property;

class PropertyCard extends Component
{
    public Property $property;
    public bool $renderReservationModal = false;

    public function showReservationModal()
    {
        $this->renderReservationModal = true;
    }

    public function render(): View
    {
        return view('livewire.property-card');
    }
}
