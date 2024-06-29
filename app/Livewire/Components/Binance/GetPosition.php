<?php

namespace App\Livewire\Components\Binance;

use Livewire\Component;

class GetPosition extends Component
{
    public $position = "";

    public function updatedPosition($val) {
        $this->dispatch('setPosition',$val);
    }
    public function render()
    {
        return view('livewire.components.binance.get-position');
    }
}
