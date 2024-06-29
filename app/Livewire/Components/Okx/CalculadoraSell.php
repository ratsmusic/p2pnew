<?php

namespace App\Livewire\Components\Okx;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class CalculadoraSell extends Component
{
    public $monedas = [];
    public $fiat = 'ARS'; // Por defecto ARS
    public $coin = 0;
    public $dinero = 0;
    public $price = 0;
    public $selectedCoin;

    public function render()
    {
        $this->getMonedas();
        return view('livewire.components.okx.calculadora-sell');
    }

    #[On('getCoins')]
    public function setFiat($fiat){
        $this->fiat = $fiat;
        $this->selectedCoin = null;
        $this->dinero = 0;
        $this->coin = 0;
    }

    public function updatedSelectedCoin() {
        foreach($this->monedas as $mon) {
            if ($this->selectedCoin == $mon->coin) {
                $this->price = $mon->price;
            }
        }
    }

    public function updatedCoin($val) {
        $this->dinero = floatval($val) * $this->price;
    }

    public function updatedDinero($val) {
        $this->coin =  floatval($val) / $this->price;
    }

    public function getMonedas()
    {
        $this->monedas = DB::table('precios_okex')
            ->select('id','coin','price')
            ->where('fiat', $this->fiat)
            ->where('type', 'sell')
            ->get();
            if (empty($this->selectedCoin)) {
                $this->selectedCoin = $this->monedas[0]->coin;
                $this->coin = floatval($this->monedas[0]->coin);
                $this->price = $this->monedas[0]->price;
            }
        

    }
}
