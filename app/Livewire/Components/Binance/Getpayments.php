<?php

namespace App\Livewire\Components\Binance;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Getpayments extends Component
{

    public $pagos = [];

    public function mount() {
        $this->getPagos('ARS');
    }
    public function render()
    {
        return view('livewire.components.binance.getpayments');
    }

    #[On('getCoins')]
    public function getPagos($fiat) {
        $berns = DB::select('SELECT pago FROM `pagos` where fiat = ?',[$fiat]);

        $trades = array_map(fn($val)=>$val->pago,$berns);


        $this->pagos = $trades;

    } 

}
