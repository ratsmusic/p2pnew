<div>
    <div class="row bg-white border-radius-lg" wire:poll>
        <div class="col-sm-4 bg-{{$color}} border-radius-lg py-5 pe-1 text-center" style="color: black;">
            <select class="form-select" style="font-weight: bold" wire:model.live='selectedCoin'>
                @foreach ($monedas as $moneda)
                    <option value="{{ $moneda->coin }}" wire:key="{{$moneda->id}}">{{ $moneda->coin }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-8 text-center py-3">
            <input type="number" class="form-control text-center" wire:model.live='coin' placeholder="Cantidad"/>
            <input type="number" class="form-control text-center" wire:model.live='dinero' readonly/>
         {{--    <span>{{$dinero}}</span> --}}
        </div>
    </div>
</div>