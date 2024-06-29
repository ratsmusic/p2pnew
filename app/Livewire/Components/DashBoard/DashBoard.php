<?php

namespace App\Livewire\Components\DashBoard;

use App\Models\OrdenCompra;
use App\Models\OrdenVenta;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $bestBuyCoin;
    public $bestBuyPrice;
    public $bestBuyExchange;
    public $bestSellCoin;
    public $bestSellPrice;
    public $bestSellExchange;
    public $potentialProfit;
    public $binanceBuy;
    public $binanceSell;
    public $kucoinBuy;
    public $kucoinSell;
    public $okexBuy;
    public $okexSell;
    public $masVendidas;
    public $masCompradas;
    public $masExchanges;
    public $webodii;
    public $webodii2;
    public $compraDay;
    public $compraWeek;
    public $compraMonth;
    public $compraYear;
    public $ventaDay;
    public $ventaWeek;
    public $ventaMonth;
    public $ventaYear;

    public function mount()
    {
        $this->getBestPrices();
        $this->getBinance();
        $this->getKucoin();
        $this->getOkex();

        $this->getMasVendidas();
        $this->getMasCompradas();
        $this->getMasExchanges();

        $this->compraDay = $this->getDataByDay();
        $this->compraWeek = $this->getDataByWeek();
        $this->compraMonth = $this->getDataByMonth();
        $this->compraYear = $this->getDataByYear();

        $this->ventaDay = $this->getDataByDayVenta();
        $this->ventaWeek = $this->getDataByWeekVenta();
        $this->ventaMonth = $this->getDataByMonthVenta();
        $this->ventaYear = $this->getDataByYearVenta();

    }

    public function getBinance() {
        $this->binanceBuy = DB::table(DB::raw('(SELECT precios.coin COLLATE utf8mb4_unicode_ci as coin, precios.price, usdt.price_usdt, precios.price/usdt.price_usdt as webodii, "Binance" as exchange 
        FROM precios
        JOIN usdt ON precios.coin COLLATE utf8mb4_unicode_ci = usdt.coin COLLATE utf8mb4_unicode_ci
        WHERE precios.fiat = "ARS" AND precios.position = 0 AND type = "buy") as combined'))
        ->orderBy('webodii', 'asc')
        ->first(['coin', 'price', 'webodii', 'exchange']);

    
    
        // Obtener el mejor precio de venta para la moneda comprada
        $this->binanceSell = DB::table(DB::raw('(SELECT precios.coin COLLATE utf8mb4_unicode_ci as coin, precios.price, usdt.price_usdt, precios.price/usdt.price_usdt as webodii, "Binance" as exchange 
        FROM precios
        JOIN usdt ON precios.coin COLLATE utf8mb4_unicode_ci = usdt.coin COLLATE utf8mb4_unicode_ci
        WHERE precios.fiat = "ARS" AND precios.position = 0 AND type = "sell") as combined'))
        ->orderBy('webodii', 'desc')
        ->first(['combined.coin', 'combined.price', 'combined.webodii', 'combined.exchange']);
            
    }
    public function getKucoin() {
        $this->kucoinBuy = DB::table(DB::raw('(SELECT precio_kucoin.coin COLLATE utf8mb4_unicode_ci as coin, precio_kucoin.price, price_usdt_kucoin.price as price_usdt, precio_kucoin.price/price_usdt_kucoin.price as webodii, "KuCoin" as exchange 
        FROM precio_kucoin
        JOIN price_usdt_kucoin ON precio_kucoin.coin COLLATE utf8mb4_unicode_ci = price_usdt_kucoin.coin COLLATE utf8mb4_unicode_ci
        WHERE precio_kucoin.fiat = "ARS" AND precio_kucoin.position = 0 AND type = "buy") as combined'))
    ->orderBy('webodii', 'asc')
    ->first(['combined.coin', 'combined.price', 'combined.webodii', 'combined.exchange']);

        $this->kucoinSell = DB::table(DB::raw('(SELECT precio_kucoin.coin COLLATE utf8mb4_unicode_ci as coin, precio_kucoin.price, price_usdt_kucoin.price as price_usdt, precio_kucoin.price/price_usdt_kucoin.price as webodii, "KuCoin" as exchange 
        FROM precio_kucoin
        JOIN price_usdt_kucoin ON precio_kucoin.coin COLLATE utf8mb4_unicode_ci = price_usdt_kucoin.coin COLLATE utf8mb4_unicode_ci
        WHERE precio_kucoin.fiat = "ARS" AND precio_kucoin.position = 0 AND type = "sell") as combined'))
    ->orderBy('webodii', 'desc')
    ->first(['combined.coin', 'combined.price', 'combined.webodii', 'combined.exchange']);
    }

    public function getOkex() {
        $this->okexBuy = DB::table(DB::raw('(SELECT precio_okex.coin COLLATE utf8mb4_unicode_ci as coin, precio_okex.price, price_usdt_okex.price as price_usdt, precio_okex.price/price_usdt_okex.price as webodii, "OKEx" as exchange 
        FROM precio_okex
        JOIN price_usdt_okex ON precio_okex.coin COLLATE utf8mb4_unicode_ci = price_usdt_okex.coin COLLATE utf8mb4_unicode_ci
        WHERE precio_okex.fiat = "ARS" AND precio_okex.position = 0 AND type = "buy") as combined'))
    ->orderBy('webodii', 'asc')
    ->first(['combined.coin', 'combined.price', 'combined.webodii', 'combined.exchange']);

        $this->okexSell = DB::table(DB::raw('(SELECT precio_okex.coin COLLATE utf8mb4_unicode_ci as coin, precio_okex.price, price_usdt_okex.price as price_usdt, precio_okex.price/price_usdt_okex.price as webodii, "OKEx" as exchange 
        FROM precio_okex
        JOIN price_usdt_okex ON precio_okex.coin COLLATE utf8mb4_unicode_ci = price_usdt_okex.coin COLLATE utf8mb4_unicode_ci
        WHERE precio_okex.fiat = "ARS" AND precio_okex.position = 0 AND type = "sell") as combined'))
    ->orderBy('webodii', 'desc')
    ->first(['combined.coin', 'combined.price', 'combined.webodii', 'combined.exchange']);
    }

    public function getMasVendidas()
{
    $fecha = date('Y-m-d');
    $intentos = 0;

    do {
        $this->masVendidas = DB::table('ordenes_venta')
            ->select('moneda_vendida', DB::raw('count(*) as cantidad'))
            ->where('estatus', '=', 'procesada')
            ->whereDate('fecha_hora', $fecha)
            ->groupBy('moneda_vendida')
            ->orderBy('cantidad', 'desc')
            ->limit(4)
            ->get();
        
        $intentos++;
        $fecha = date('Y-m-d', strtotime("-$intentos day"));
    } while ($this->masVendidas->isEmpty() && $intentos <= 7);

    if (!$this->masVendidas->isEmpty()) {
        $total = 0;
        foreach ($this->masVendidas as $moneda) {
            $total += $moneda->cantidad;
        }

        foreach ($this->masVendidas as &$moneda) {
            $porcentaje = ($moneda->cantidad / $total) * 100;
            $moneda->porcentaje = round($porcentaje, 2);
        }
    }
}

public function getMasCompradas()
{
    $fecha = date('Y-m-d');
    $intentos = 0;

    do {
        $this->masCompradas = DB::table('ordenes_compra')
            ->select('moneda_comprada', DB::raw('count(*) as cantidad'))
            ->where('estatus', '=', 'procesada')
            ->whereDate('fecha_hora', $fecha)
            ->groupBy('moneda_comprada')
            ->orderBy('cantidad', 'desc')
            ->limit(4)
            ->get();
        
        $intentos++;
        $fecha = date('Y-m-d', strtotime("-$intentos day"));
    } while ($this->masCompradas->isEmpty() && $intentos <= 7);

    if (!$this->masCompradas->isEmpty()) {
        $total = 0;
        foreach ($this->masCompradas as $moneda) {
            $total += $moneda->cantidad;
        }

        foreach ($this->masCompradas as &$moneda) {
            $porcentaje = ($moneda->cantidad / $total) * 100;
            $moneda->porcentaje = round($porcentaje, 2);
        }
    }
}

public function getMasExchanges()
{
    // Intentar obtener los datos del día actual
    $this->masExchanges = DB::table('ordenes_venta')
        ->join('ordenes_compra', 'ordenes_venta.exchange', '=', 'ordenes_compra.exchange')
        ->select('ordenes_venta.exchange', DB::raw('count(*) as cantidad'), DB::raw('count(ordenes_venta.exchange) as cantidad_venta'), DB::raw('count(ordenes_compra.exchange) as cantidad_compra'))
        ->where('ordenes_venta.estatus', '=', 'procesada')
        ->whereDate('ordenes_venta.fecha_hora', date('Y-m-d'))
        ->groupBy('ordenes_venta.exchange')
        ->orderBy('cantidad', 'desc')
        ->limit(4)
        ->get();

    // Si no hay datos del día actual, obtener la fecha más reciente con datos y usar esa fecha
    if ($this->masExchanges->isEmpty()) {
        $latestDate = DB::table('ordenes_venta')
            ->where('estatus', '=', 'procesada')
            ->max('fecha_hora');
        
        if ($latestDate) {
            $latestDate = date('Y-m-d', strtotime($latestDate));
            $this->masExchanges = DB::table('ordenes_venta')
                ->join('ordenes_compra', 'ordenes_venta.exchange', '=', 'ordenes_compra.exchange')
                ->select('ordenes_venta.exchange', DB::raw('count(*) as cantidad'), DB::raw('count(ordenes_venta.exchange) as cantidad_venta'), DB::raw('count(ordenes_compra.exchange) as cantidad_compra'))
                ->where('ordenes_venta.estatus', '=', 'procesada')
                ->whereDate('ordenes_venta.fecha_hora', $latestDate)
                ->groupBy('ordenes_venta.exchange')
                ->orderBy('cantidad', 'desc')
                ->limit(4)
                ->get();
        }
    }

    // Calcular el total y los porcentajes
    $total = 0;
    foreach ($this->masExchanges as $exchange) {
        $total += $exchange->cantidad;
    }

    foreach ($this->masExchanges as &$exchange) {
        $porcentaje = ($exchange->cantidad / $total) * 100;
        $exchange->porcentaje = round($porcentaje, 2);
    }

    // Para depuración
    // dd(array_map(fn($val)=>$val->exchange, $this->masExchanges->toArray()));
}


public function getBestPrices()
{
    // Obtener el mejor precio de compra entre todos los exchanges
    $bestBuy = DB::table(DB::raw('(SELECT precios.coin COLLATE utf8mb4_unicode_ci as coin, precios.price, usdt.price_usdt, precios.price/usdt.price_usdt as webodii, "Binance" as exchange 
    FROM precios
    JOIN usdt ON precios.coin COLLATE utf8mb4_unicode_ci = usdt.coin COLLATE utf8mb4_unicode_ci
    WHERE precios.fiat = "ARS" AND precios.position = 0 AND type = "buy"

    UNION

    SELECT precio_kucoin.coin COLLATE utf8mb4_unicode_ci as coin, precio_kucoin.price, price_usdt_kucoin.price as price_usdt, precio_kucoin.price/price_usdt_kucoin.price as webodii, "KuCoin" as exchange 
    FROM precio_kucoin
    JOIN price_usdt_kucoin ON precio_kucoin.coin COLLATE utf8mb4_unicode_ci = price_usdt_kucoin.coin COLLATE utf8mb4_unicode_ci
    WHERE precio_kucoin.fiat = "ARS" AND precio_kucoin.position = 0 AND type = "buy"

    UNION

    SELECT precio_okex.coin COLLATE utf8mb4_unicode_ci as coin, precio_okex.price, price_usdt_okex.price as price_usdt, precio_okex.price/price_usdt_okex.price as webodii, "OKEx" as exchange 
    FROM precio_okex
    JOIN price_usdt_okex ON precio_okex.coin COLLATE utf8mb4_unicode_ci = price_usdt_okex.coin COLLATE utf8mb4_unicode_ci
    WHERE precio_okex.fiat = "ARS" AND precio_okex.position = 0 AND type = "buy") as combined'))
->orderBy('webodii', 'asc')
->first(['combined.coin', 'combined.price', 'combined.webodii', 'combined.exchange']);
    
    $this->bestBuyCoin = $bestBuy->coin;
    $this->bestBuyPrice = $bestBuy->price;
    $this->webodii = $bestBuy->webodii;
    $this->bestBuyExchange = $bestBuy->exchange;

    if ($bestBuy) {
        // Obtener el mejor precio de venta para la moneda comprada
        $bestSell = DB::table(DB::raw('(SELECT precios.coin COLLATE utf8mb4_unicode_ci as coin, precios.price, usdt.price_usdt, precios.price/usdt.price_usdt as webodii, "Binance" as exchange 
        FROM precios
        JOIN usdt ON precios.coin COLLATE utf8mb4_unicode_ci = usdt.coin COLLATE utf8mb4_unicode_ci
        WHERE precios.fiat = "ARS" AND precios.position = 0 AND type = "sell" AND precios.coin = "'.$bestBuy->coin.'"
    
        UNION
    
        SELECT precio_kucoin.coin COLLATE utf8mb4_unicode_ci as coin, precio_kucoin.price, price_usdt_kucoin.price as price_usdt, precio_kucoin.price/price_usdt_kucoin.price as webodii, "KuCoin" as exchange 
        FROM precio_kucoin
        JOIN price_usdt_kucoin ON precio_kucoin.coin COLLATE utf8mb4_unicode_ci = price_usdt_kucoin.coin COLLATE utf8mb4_unicode_ci
        WHERE precio_kucoin.fiat = "ARS" AND precio_kucoin.position = 0 AND type = "sell" AND price_usdt_kucoin.coin = "'.$bestBuy->coin.'"
    
        UNION
    
        SELECT precio_okex.coin COLLATE utf8mb4_unicode_ci as coin, precio_okex.price, price_usdt_okex.price as price_usdt, precio_okex.price/price_usdt_okex.price as webodii, "OKEx" as exchange 
        FROM precio_okex
        JOIN price_usdt_okex ON precio_okex.coin COLLATE utf8mb4_unicode_ci = price_usdt_okex.coin COLLATE utf8mb4_unicode_ci
        WHERE precio_okex.fiat = "ARS" AND precio_okex.position = 0 AND type = "sell" AND price_usdt_okex.coin = "'.$bestBuy->coin.'") as combined'))
    ->orderBy('webodii', 'desc')
    ->first(['combined.coin', 'combined.price', 'combined.webodii', 'combined.exchange']);

    

        if ($bestSell) {
            // Asignar los valores obtenidos a las variables del componente      
            $this->webodii2 = $bestSell->webodii;    
            
            $this->bestSellCoin = $bestSell->coin;
            $this->bestSellPrice = $bestSell->price;
            $this->bestSellExchange = $bestSell->exchange;

            // Calcular el porcentaje de profit potencial
            $this->potentialProfit = ($this->webodii2 - $this->webodii) * 100 / ($this->webodii2 + $this->webodii);
        } else {
            // No se encontró un mejor precio de venta para la moneda comprada
            $this->bestSellCoin = null;
            $this->bestSellPrice = null;
            $this->bestSellExchange = null;
            $this->potentialProfit = 0;
            $this->webodii = null;
        }
    } else {
        // No se encontró un mejor precio de compra
        $this->bestBuyCoin = null;
        $this->bestBuyPrice = null;
        $this->bestBuyExchange = null;
        $this->bestSellCoin = null;
        $this->bestSellPrice = null;
        $this->bestSellExchange = null;
        $this->webodii = null;
        $this->potentialProfit = 0;
    }
}


    public function render()
    {
        return view('livewire.components.dash-board.dash-board');
    }

    private function getDataByDay()
    {
        $data = [];
        $now = Carbon::now();
        $today = Carbon::today();

        $data[] = OrdenCompra::where('estatus','!=','cancelada')->whereCreatedBy(\Auth::id())->whereBetween('fecha_hora', [$today->copy()->setTime(6, 0), $today->copy()->setTime(9, 0)])->count();
        $data[] = OrdenCompra::where('estatus','!=','cancelada')->whereCreatedBy(\Auth::id())->whereBetween('fecha_hora', [$today->copy()->setTime(9, 0), $today->copy()->setTime(12, 0)])->count();
        $data[] = OrdenCompra::where('estatus','!=','cancelada')->whereCreatedBy(\Auth::id())->whereBetween('fecha_hora', [$today->copy()->setTime(12, 0), $today->copy()->setTime(15, 0)])->count();
        $data[] = OrdenCompra::where('estatus','!=','cancelada')->whereCreatedBy(\Auth::id())->whereBetween('fecha_hora', [$today->copy()->setTime(15, 0), $today->copy()->setTime(18, 0)])->count();
        $data[] = OrdenCompra::where('estatus','!=','cancelada')->whereCreatedBy(\Auth::id())->whereBetween('fecha_hora', [$today->copy()->setTime(18, 0), $today->copy()->setTime(21, 0)])->count();
        $data[] = OrdenCompra::where('estatus','!=','cancelada')->whereCreatedBy(\Auth::id())->whereBetween('fecha_hora', [$today->copy()->setTime(21, 0), $today->copy()->setTime(23, 59, 59)])->count();
        $data[] = OrdenCompra::where('estatus','!=','cancelada')->whereCreatedBy(\Auth::id())->whereBetween('fecha_hora', [$today->copy()->setTime(0, 0), $today->copy()->setTime(3, 0)])->count();
        $data[] = OrdenCompra::where('estatus','!=','cancelada')->whereCreatedBy(\Auth::id())->whereBetween('fecha_hora', [$today->copy()->setTime(3, 0), $today->copy()->setTime(6, 0)])->count();

        return $data;
    }

    private function getDataByWeek()
    {
        $data = [];
        $now = Carbon::now();

        for ($day = 0; $day < 7; $day++) {
            $data[] = OrdenCompra::where('estatus','!=','cancelada')->whereCreatedBy(\Auth::id())->whereBetween('fecha_hora', [
                $now->copy()->startOfWeek()->addDays($day)->startOfDay(),
                $now->copy()->startOfWeek()->addDays($day)->endOfDay()
            ])->count();
        }

        return $data;
    }

    private function getDataByMonth()
    {
        $data = [];
        $now = Carbon::now();

        for ($week = 0; $week < 4; $week++) {
            $data[] = OrdenCompra::where('estatus','!=','cancelada')->whereCreatedBy(\Auth::id())->whereBetween('fecha_hora', [
                $now->copy()->startOfMonth()->addWeeks($week)->startOfWeek(),
                $now->copy()->startOfMonth()->addWeeks($week)->endOfWeek()
            ])->count();
        }

        return $data;
    }

    private function getDataByYear()
    {
        $data = [];
        $now = Carbon::now();

        for ($month = 1; $month <= 12; $month++) {
            $data[] = OrdenCompra::where('estatus','!=','cancelada')->whereCreatedBy(\Auth::id())->whereYear('fecha_hora', $now->year)
                                 ->whereMonth('fecha_hora', $month)
                                 ->count();
        }

        return $data;
    }
    ////////
    private function getDataByDayVenta()
    {
        $data = [];
        $now = Carbon::now();
        $today = Carbon::today();

        $data[] = OrdenVenta::where('estatus','!=','cancelada')->whereCreatedBy(\Auth::id())->whereBetween('fecha_hora', [$today->copy()->setTime(6, 0), $today->copy()->setTime(9, 0)])->count();
        $data[] = OrdenVenta::where('estatus','!=','cancelada')->whereCreatedBy(\Auth::id())->whereBetween('fecha_hora', [$today->copy()->setTime(9, 0), $today->copy()->setTime(12, 0)])->count();
        $data[] = OrdenVenta::where('estatus','!=','cancelada')->whereCreatedBy(\Auth::id())->whereBetween('fecha_hora', [$today->copy()->setTime(12, 0), $today->copy()->setTime(15, 0)])->count();
        $data[] = OrdenVenta::where('estatus','!=','cancelada')->whereCreatedBy(\Auth::id())->whereBetween('fecha_hora', [$today->copy()->setTime(15, 0), $today->copy()->setTime(18, 0)])->count();
        $data[] = OrdenVenta::where('estatus','!=','cancelada')->whereCreatedBy(\Auth::id())->whereBetween('fecha_hora', [$today->copy()->setTime(18, 0), $today->copy()->setTime(21, 0)])->count();
        $data[] = OrdenVenta::where('estatus','!=','cancelada')->whereCreatedBy(\Auth::id())->whereBetween('fecha_hora', [$today->copy()->setTime(21, 0), $today->copy()->setTime(23, 59, 59)])->count();
        $data[] = OrdenVenta::where('estatus','!=','cancelada')->whereCreatedBy(\Auth::id())->whereBetween('fecha_hora', [$today->copy()->setTime(0, 0), $today->copy()->setTime(3, 0)])->count();
        $data[] = OrdenVenta::where('estatus','!=','cancelada')->whereCreatedBy(\Auth::id())->whereBetween('fecha_hora', [$today->copy()->setTime(3, 0), $today->copy()->setTime(6, 0)])->count();

        return $data;
    }

    private function getDataByWeekVenta()
    {
        $data = [];
        $now = Carbon::now();

        for ($day = 0; $day < 7; $day++) {
            $data[] = OrdenVenta::where('estatus','!=','cancelada')->whereCreatedBy(\Auth::id())->whereBetween('fecha_hora', [
                $now->copy()->startOfWeek()->addDays($day)->startOfDay(),
                $now->copy()->startOfWeek()->addDays($day)->endOfDay()
            ])->count();
        }

        return $data;
    }

    private function getDataByMonthVenta()
    {
        $data = [];
        $now = Carbon::now();

        for ($week = 0; $week < 4; $week++) {
            $data[] = OrdenVenta::where('estatus','!=','cancelada')->whereCreatedBy(\Auth::id())->whereBetween('fecha_hora', [
                $now->copy()->startOfMonth()->addWeeks($week)->startOfWeek(),
                $now->copy()->startOfMonth()->addWeeks($week)->endOfWeek()
            ])->count();
        }

        return $data;
    }

    private function getDataByYearVenta()
    {
        $data = [];
        $now = Carbon::now();

        for ($month = 1; $month <= 12; $month++) {
            $data[] = OrdenVenta::where('estatus','!=','cancelada')->whereCreatedBy(\Auth::id())->whereYear('fecha_hora', $now->year)
                                 ->whereMonth('fecha_hora', $month)
                                 ->count();
        }

        return $data;
    }

}
