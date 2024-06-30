<div>
    <div class="flex justify-between flex-col sm:flex-row items-center mb-6">
        <img src="{{ asset('assets/images/binance.png') }}" alt="Binance" class="h-12">
        <div class="p-4 bg-secondaryBg rounded-lg w-3/4 my-6 sm:w-1/4 ml-auto flex flex-col items-end">
            <label for="fiat-select" class="block text-sm font-medium py-2">Moneda FIAT</label>
            <select class=" form-select ms-auto w-full bg-primaryBg border border-brand text-white focus:ouline-none focus:border-brand py-2 px-4 rounded-lg cursor-pointer"id="selectMoneda" wire:model.live="fiat" wire:loading.attr="disabled">
                <option selected disabled value="">-- Seleccione --</option>
                <option>USD</option>
                <option>VES</option>
                <option>COP</option>
                <option>PEN</option>
                <option>ARS</option>
                <option>UYU</option>
                <option>PYG</option>
                <option>CLP</option>
                <option>BRL</option>
                <option>MXN</option>
            </select>
        </div>
    </div>  
</div>