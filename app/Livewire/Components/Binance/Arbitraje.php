<?php

namespace App\Livewire\Components\Binance;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Arbitraje extends Component
{   
    public $monedas_sell = [];
    public $monedas_buy = [];
    public $principiante_sell = [];
    public $principiante_buy = [];
    public $moneda3 = '';
    public $posiciones = [];
    public $posiciones2 = [];
    public $coinpos = [];
    public $coinpos2 = [];
    public $todotodo = [];

    public $selectedCoin = "";
    public $selectedPos = 0;
    public $scoin = false;

    public $tab = 0;

    protected $queryString = [ 'tab'];



    #[On('todotodo')]
    public function todotodo($val) {
        $this->todotodo = $val;
        //dd($val);
    }

    #[On('posiciones')]

    public function posiciones($pos) {
        $this->posiciones = $pos;
    }

    public function updatedSelectedCoin() {
       // dd($this->todotodo[$val]);
      // dd($this->selectedPos);
      $this->scoin = true;
      $this->selectedPos = 0;
    }

    #[On('posiciones2')]

    public function posiciones2($pos) {
        $this->posiciones2 = $pos;
    }
    #[On('monedas')]
    public function monedas($val) {
        // Ordenar las ventas (val_sell) de mayor a menor
        $this->monedas_sell = $val;
        usort($this->monedas_sell, function($a, $b) {
            return $a['val_sell'] <=> $b['val_sell'];
        });
    
        // Ordenar las compras (val_buy) de menor a mayor
        $this->monedas_buy = $val;
        usort($this->monedas_buy, function($a, $b) {
            return $b['val_buy'] <=> $a['val_buy'];
        });

        $this->principiante_sell = $val;
        usort($this->principiante_sell, function ($a, $b) {
            return $b['val_sell'] <=> $a['val_sell'];
        });

        // Ordenar las compras (val_buy) de menor a mayor
        $this->principiante_buy = $val;
        usort($this->principiante_buy, function ($a, $b) {
            return $a['val_buy'] <=> $b['val_buy'];
        });
        //dd($this->selectedCoin);
        /* if (count($this->monedas_buy)>2) {
            if (!$this->scoin) {
                $this->selectedCoin = $this->monedas_buy[2]['coin'];
                $this->selectedCoin = '';
                $this->scoin = true;
            }
        } else {
            $this->selectedCoin = '';
            $this->scoin = false;
        }
         */

        if (!isset($this->posiciones[$this->selectedCoin])) {
            $this->selectedCoin = "";

        } 
 

    }


    
    public function actualizarPos($coin, $pos) {
        $this->dispatch('newPos',$coin, $pos);
    }

    public function actualizarPos2($coin, $pos) {
        $this->dispatch('newPos2',$coin, $pos);
    }

    public function render()
    {
        return view('livewire.components.binance.arbitraje');
    }
}
