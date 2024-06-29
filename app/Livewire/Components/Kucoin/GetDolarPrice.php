<?php

namespace App\Livewire\Components\Kucoin;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class GetDolarPrice extends Component
{
    public $official;
    public $blue;
    public $mep;
    public $fiat = 'ARS';

    public function  mount() {
        $berns = DB::select('SELECT * FROM `dolar` where fiat = ?',[$this->fiat]);
 

        $this->official = $berns[0]->official_price;
        $this->blue = $berns[0]->blue_price;
        $this->mep = $berns[0]->mep_price;
    }

    public function render()
    {
        return view('livewire.components.kucoin.get-dolar-price');
    }

    #[On('QuienQuiereFiat')]
    public function webodii($x) {
        $this->fiat = $x;
    }
}
