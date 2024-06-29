<?php

namespace App\Livewire\Components\Okx;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class Gracompra extends Component
{   
   public $fiat = 'ARS';


    public function render()
    {
        $this->getVolume($this->fiat);
        return view('livewire.components.okx.gracompra');
    }

    #[On('getVolume')]
    public function getVolume($fiat) {
        $this->fiat = $fiat;
        
        $sql = DB::select('
            SELECT coin, SUM(cantidad_duplicados) AS total_vendido
            FROM (
                SELECT coin, idtransaccion, COUNT(*) AS cantidad_duplicados
                FROM volumen_okex
                WHERE tradeType = "buy" AND fiat = ?
                AND DATE(created_at) = CURDATE() 
                GROUP BY coin, idtransaccion
            ) AS duplicados
            GROUP BY coin
            ORDER BY total_vendido DESC
        ', [$this->fiat]);
    
        $total_vendido = [];
        $labels = [];
    
        foreach ($sql as $vol) {
            $total_vendido[] = $vol->total_vendido;
            $labels[] = $vol->coin;
        }
    
        $arreglo = [
            'labels' => $labels,
            'datos' => $total_vendido 
        ];
    
        $this->dispatch("updateChart", $arreglo);
    }
    
}
