<?php

namespace App\Livewire\Components\Binance;

use Livewire\Component;

class Getfiat extends Component
{

    public $fiat = "ARS";

    public function render()
    {
        return view('livewire.components.binance.getfiat');
    }
     
    public function updatedFiat() {
        $this->dispatch("getCoins",$this->fiat);
        $this->dispatch("getVolume",$this->fiat);
        $this->dispatch("QuienQuiereFiat",$this->fiat);

   
    }
    
}
