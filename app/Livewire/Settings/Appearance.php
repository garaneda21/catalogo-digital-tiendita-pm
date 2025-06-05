<?php

namespace App\Livewire\Settings;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Appearance extends Component
{
    /**
     * Incluye el layout del catalogo a los settings de livewire.
     */
    public function render()
    {
        return view('livewire.settings.appearance')
            ->layout('components.layouts.estructura');

    }
}
