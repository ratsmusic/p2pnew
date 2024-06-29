<div>
    <label for="selectMoneda">Moneda Fiat</label>
    <select class="form-select ms-auto" id="selectMoneda" wire:model.live="fiat" wire:loading.attr="disabled">
        <option selected disabled value="">-- Seleccione --</option>
        <option>USD</option>
        <option>COP</option>
        <option>ARS</option>
        <option>BRL</option>
        <option>MXN</option>

        <!-- Aquí puedes agregar más opciones si es necesario -->
    </select>
</div>
