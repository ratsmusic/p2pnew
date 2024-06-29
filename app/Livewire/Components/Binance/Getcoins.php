<?php

namespace App\Livewire\Components\Binance;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Session;

class Getcoins extends Component
{

    
    public $monedas = [];
    public $monedas2 = [];
    
    public $fiat = "ARS";
    public $symbols = [];
    public $valor; 
    public $valor2;

    public $coinpos = [];
    public $coinpos2 = [];

    public function render()
    {   
        $this->getCoins($this->fiat);
        return view('livewire.components.binance.getcoins');
    }

    #[On('newPos')]
    public function newPos($coin, $pos) {

        $this->coinpos[$coin] = $pos;
       
    }

    #[On('newPos2')]
    public function newPos2($coin, $pos) {

        $this->coinpos2[$coin] = $pos;
       
    }

    public function todotodo() {
        // Obtener los datos de la base de datos
        $berns = DB::select('SELECT `type`, coin, price, position FROM `precios` WHERE fiat = ?', [$this->fiat]);
    
        $this->monedas = [];
    
        // Procesar las posiciones
        foreach ($berns as $bernsItem) {
            $coin = $bernsItem->coin;
            $price = $bernsItem->price;
            $type = $bernsItem->type;
    
            if (!isset($this->monedas[$coin])) {
                $this->monedas[$coin] = ['buy' => [], 'sell' => []];
            }
    
            if ($type == 'buy') {
                $this->monedas[$coin]['buy'][$bernsItem->position] = ['price_buy' => $price];
            } elseif ($type == 'sell') {
                $this->monedas[$coin]['sell'][$bernsItem->position] = ['price_sell' => $price];
            }
        }
    
        $berns = DB::select('SELECT coin, `price_usdt` FROM `usdt`');
    
        $bernsPrecios = [];
        foreach ($berns as $bernsItem) {
            $bernsPrecios[$bernsItem->coin] = $bernsItem->price_usdt;
        }
    
        foreach ($this->monedas as $coin => &$positions) {
            foreach (['buy', 'sell'] as $type) {
                foreach ($positions[$type] as $position => &$moneda) {
                    if ($coin == 'USDT') {
                        $moneda['symbol_price'] = 1;
                    } else {
                        $moneda['symbol_price'] = $bernsPrecios[$coin] ?? null;
                    }

                    $moneda['symbol'] = $coin . "USDT";
                    if ($type == 'buy') {
                        $moneda['val_buy'] = round($moneda['price_buy'] / $moneda['symbol_price'], 2);
                    } elseif ($type == 'sell') {
                        $moneda['val_sell'] = round($moneda['price_sell'] / $moneda['symbol_price'], 2);
                    }
    
                    $moneda['signo'] = '';
                    $moneda['percent'] = '0';
                }
            }
        }
    
        $this->valor = session('valor') ?? [];
    
        foreach ($this->monedas as $coin => &$positions) {
            foreach (['buy', 'sell'] as $type) {
                foreach ($positions[$type] as $position => &$moneda) {
                    $value = $this->valor[$coin][$type][$position] ?? 0;
    
                    $this->valor[$coin][$type][$position] = $moneda['symbol_price'];
    
                    if ($moneda['symbol_price'] == 0) {
                        dd($moneda);
                    }
    
                    if ($value != 0) {
                        $diff = round($moneda['symbol_price'] - $value, 6);
    
                        if ($diff != 0) {
                            $signo = $diff > 0 ? '+' : ($diff < 0 ? '-' : '');
                            $valuex = abs($diff);
                            $moneda['signo'] = $signo;
                            $moneda['percent'] = round((($moneda['symbol_price'] - $valuex) * 100 / $moneda['symbol_price']) - 100, 2) * -1;
                        }
                    }
                    if ($moneda['percent'] == '0') $moneda['signo'] = '';
                }
            }
        }
    
        session(["valor" => $this->valor]);
    
        // Dispatch the updated monedas with all positions
        $this->dispatch('todotodo', $this->monedas);
    
        // Debugging: dump the monedas array
    }
    
    
    
    
   

    #[On('getCoins')]
    public function getCoins($fiat) {
      //  dd($this->coinpos);
        $this->fiat = $fiat;
        $berns = DB::select('SELECT `type`,coin,price, position FROM `precios` where fiat = ?',[$fiat]);

        $this->todotodo();
        $this->monedas = [];
        foreach ($berns as $bernsItem) {

            if (array_key_exists($bernsItem->coin,$this->coinpos)) {
                if ($bernsItem->position != $this->coinpos[$bernsItem->coin]) continue;
            } else {
                if ($bernsItem->position != 0) continue;
            }

    
            $coin = $bernsItem->coin;
            $price = $bernsItem->price;
            $type = $bernsItem->type;
        
            if ($type == 'buy') continue;
            // Verificar si ya existe la moneda en $this->monedas
            $coinIndex = array_search($coin, array_column($this->monedas, 'coin'));
        
            if ($coinIndex !== false) {
                // La moneda ya existe en $this->monedas, actualizar el precio según el tipo
                $this->monedas[$coinIndex]['price_sell'] = $price;
            } else {
                // La moneda no existe en $this->monedas, añadirla como un nuevo elemento
                $moneda = ['coin' => $coin];
                $moneda['price_sell'] = $price;
                $this->monedas[] = $moneda;
            }
        }


        foreach ($berns as $bernsItem) {

            if (array_key_exists($bernsItem->coin,$this->coinpos2)) {
                if ($bernsItem->position != $this->coinpos2[$bernsItem->coin]) continue;
            } else {
                if ($bernsItem->position != 0) continue;
            }

    
            $coin = $bernsItem->coin;
            $price = $bernsItem->price;
            $type = $bernsItem->type;
        
            

            if ($type == 'sell') continue;
            // Verificar si ya existe la moneda en $this->monedas
            $coinIndex = array_search($coin, array_column($this->monedas, 'coin'));
        
            if ($coinIndex !== false) {
                // La moneda ya existe en $this->monedas, actualizar el precio según el tipo
                $this->monedas[$coinIndex]['price_buy'] = $price;
            } else {
                // La moneda no existe en $this->monedas, añadirla como un nuevo elemento
                $moneda = ['coin' => $coin];
                $moneda['price_buy'] = $price;
                $this->monedas[] = $moneda;
            }
        }
        //dd($this->monedas);

        $berns = DB::select('SELECT coin,`price_usdt` FROM `usdt`');

        $bernsPrecios = [];
        foreach ($berns as $bernsItem) {
            $bernsPrecios[$bernsItem->coin] = $bernsItem->price_usdt;
        }

        foreach ($this->monedas as &$moneda) {
            $coin = $moneda['coin'];
            if ($coin=='USDT') {
                $moneda['symbol_price'] = 1;
                continue;
            }
            if (isset($bernsPrecios[$coin])) {
                $moneda['symbol_price'] = $bernsPrecios[$coin];
            } else {
              
                $moneda['symbol_price'] = null; 

            }
        }
        $this->valor = session('valor') ?? [];

          
        foreach ($this->monedas as $key=> $mon) {
            
     
           $this->valor[$key] =  $this->valor[$key] ?? 0;
            
            $value = $this->valor[$key];
      
            $this->valor[$key] = $this->monedas[$key]['symbol_price'];

            if ($this->monedas[$key]['symbol_price']==0){
                dd( $this->monedas[$key]);
            }
//if (!isset($this->monedas[$key]['price_buy'])) dd($this->monedas[$key]);

            $this->monedas[$key]['symbol'] = $mon['coin']."USDT";
            $this->monedas[$key]['val_buy'] = round($this->monedas[$key]['price_buy'] / $this->monedas[$key]['symbol_price'],2);
            $this->monedas[$key]['val_sell'] = round($this->monedas[$key]['price_sell'] / $this->monedas[$key]['symbol_price'],2);

          
            $this->monedas[$key]['signo'] = '';

            if ($value == 0) {
                $this->monedas[$key]['signo'] = "";
                $this->monedas[$key]['percent'] = "0";
                
            } else {
                $diff = round($this->monedas[$key]['symbol_price'] - $value,6);

    
                if ($diff == 0) {
                    $this->monedas[$key]['percent'] = "0";
                } else {
                    $signo = $diff>0 ? '+' : ($diff < 0 ? '-':'');
                    $valuex = abs($diff);
                    $this->monedas[$key]['signo'] = $signo;
                    $this->monedas[$key]['percent'] = round((($this->monedas[$key]['symbol_price'] - $valuex ) * 100 / $this->monedas[$key]['symbol_price'])-100,2)*-1;
                }
            }
            if ($this->monedas[$key]['percent']==0) $this->monedas[$key]['signo'] = "";
            session(["valor"=>$this->valor]);
        }

        $posiciones = DB::select("SELECT * FROM `precios` where fiat = ? and `type` = 'buy'", [$this->fiat]);


        $coins = array_map(fn($v)=>$v['coin'], $this->monedas);

        $posx = [];

        foreach ($coins as $c) {

            foreach ($posiciones as $pos) {
      
                if ($pos->coin == $c) {

                    $posx[$c][] = $pos->position;
                }
            }
        }


        $posiciones = DB::select("SELECT * FROM `precios` where fiat = ? and `type` = 'sell'", [$this->fiat]);


        $coins = array_map(fn($v)=>$v['coin'], $this->monedas);

        $posx2 = [];

        foreach ($coins as $c) {

            foreach ($posiciones as $pos) {
      
                if ($pos->coin == $c) {

                    $posx2[$c][] = $pos->position;
                }
            }
        }

       

        $this->dispatch('monedas',$this->monedas);
        $this->dispatch('posiciones',$posx);
        $this->dispatch('posiciones2',$posx2);
    }

  
}
