<div>
    <div class="row" wire:poll.2000ms>
        <pre></pre>
        @php
        if (!function_exists('format_price')) {
            function format_price($symbol, $price) {
                $decimals = 2; // Default
                if (in_array(strtoupper($symbol), ['ADA', 'XRP'])) {
                    $decimals = 4;
                } elseif (strtoupper($symbol) === 'DOGE') {
                    $decimals = 5;
                }
                return number_format($price, $decimals, ',', '.');
            }
        }
        @endphp

        @foreach($monedas as $moneda)
            @if(!in_array($moneda['coin'], ['FDUSD', 'DAI', 'USDT', 'USDC']))
                <div class="col-2 text-center">
                    <div class="text-2xl text-bolder" style="color: black;">
                        <img src="{{ asset('img/coin/' . strtolower($moneda['coin']) . '.svg') }}" alt="{{ $moneda['coin'] }} Logo" style="height: 24px; vertical-align: middle; margin-right: 5px;">
                        {{$moneda['coin']}}
                    </div>
                    <div>USD {{ format_price($moneda['coin'], $moneda['symbol_price']) }}</div>
                </div>
            @endif
        @endforeach
    </div>
</div>
