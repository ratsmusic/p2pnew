<?php
namespace App\Livewire\Components\Binance;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class CalculadoraBuy extends Component
{
    public $monedas = [];
    public $fiat = 'ARS'; // Por defecto ARS
    public $coin = 0;
    public $dinero = 0;
    public $price = 0;
    public $selectedCoin;
    public $usdt=0;
    public $color ="success";
    public $tradeType = 'buy';

    public function render()
    {
        $this->getMonedas();
        return view('livewire.components.binance.calculadora-buy');
    }

    #[On('getCoins')]
    public function setFiat($fiat)
    {
        $this->fiat = $fiat;
        $this->selectedCoin = null;
        $this->dinero = 0;
        $this->coin = 0;
        
    }

    public function updatedSelectedCoin()
    {
      //  dd($this->monedas);
        foreach ($this->monedas as $mon) {
            if ($this->selectedCoin == $mon->coin) {
                $this->price = $mon->price;
                $this->usdt = $mon->price_usdt;
            }
        }
        $this->dinero = 0;
        $this->coin = 0;
    }

    public function updatedCoin($val)
    {
        
        $this->dinero = $this->coin > 0 ? number_format($this->coin / $this->usdt,2,'.','') : 0;

    }

    public function getMonedas()
    {
        $this->monedas = DB::table('precios')
            ->select('precios.id', 'precios.coin', 'precios.price', 'usdt.price_usdt')
            ->join('usdt', 'precios.coin', '=', 'usdt.coin')
            ->where('precios.fiat', $this->fiat)
            ->where('precios.type',$this->tradeType)
            ->get();
    
        if (empty($this->selectedCoin) && count($this->monedas) > 0) {
            $this->selectedCoin = $this->monedas[0]->coin;
            $this->coin = floatval($this->monedas[0]->coin);
            $this->price = $this->monedas[0]->price;
            $this->usdt = $this->monedas[0]->price_usdt; 
        }
    }
    
}
