<div>
    <label for="selectMetodoPago">Método de pago</label>
    <select class="form-select ms-auto" id="selectMetodoPago" wire:loading.attr="disabled">
        @foreach ($pagos as $pago)
        <option selected>{{$pago}}</option>
        @endforeach
        <!-- Aquí puedes agregar más opciones si es necesario -->
    </select>
</div>
