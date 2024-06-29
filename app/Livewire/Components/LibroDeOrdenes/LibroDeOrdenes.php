<?php

namespace App\Livewire\Components\LibroDeOrdenes;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\OrdenCompra;
use App\Models\OrdenVenta;
use Illuminate\Support\Facades\Log;

class LibroDeOrdenes extends Component
{
    use WithPagination;

    public $activeTab = 'BUY'; // 'BUY' or 'SELL'
    public $ordenId;
    public $pais;
    public $fecha;
    public $exchange;
    public $moneda_comprada;
    public $precio_usd_comprado;
    public $precio_fiat_comprado;
    public $cantidad_fiat_comprado;
    public $moneda_vendida;
    public $precio_usd_vendido;
    public $precio_fiat_vendido;
    public $cantidad_fiat_vendido;
    public $estatus;
    public $searchFecha;
    public $searchExchange;

    public function render()
    {
        $ordenesCompra = OrdenCompra::when($this->searchFecha, function($query) {
            $query->whereDate('fecha_hora', $this->searchFecha);
        })->when($this->searchExchange, function($query) {
            $query->where('exchange', 'like', '%'.$this->searchExchange.'%');
        })->paginate(10);

        $ordenesVenta = OrdenVenta::when($this->searchFecha, function($query) {
            $query->whereDate('fecha_hora', $this->searchFecha);
        })->when($this->searchExchange, function($query) {
            $query->where('exchange', 'like', '%'.$this->searchExchange.'%');
        })->paginate(10);

        return view('livewire.components.libro-de-ordenes.libro-de-ordenes', [
            'ordenesCompra' => $ordenesCompra,
            'ordenesVenta' => $ordenesVenta,
        ]);
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetInputFields();
        $this->resetPage(); // Resetear la paginación al cambiar de pestaña
    }

    private function resetInputFields()
    {
        $this->ordenId = null;
        $this->pais = '';
        $this->fecha = '';
        $this->exchange = '';
        $this->moneda_comprada = '';
        $this->precio_usd_comprado = '';
        $this->precio_fiat_comprado = '';
        $this->cantidad_fiat_comprado = '';
        $this->moneda_vendida = '';
        $this->precio_usd_vendido = '';
        $this->precio_fiat_vendido = '';
        $this->cantidad_fiat_vendido = '';
        $this->estatus = '';
    }

    public function store()
    {
        $this->validateOrderData();

        if ($this->ordenId) {
            $this->updateOrder();
        } else {
            $this->createOrder();
        }

        session()->flash('message', $this->ordenId ? 'Orden actualizada exitosamente.' : 'Orden creada exitosamente.');
        $this->resetInputFields();
    }

    private function validateOrderData()
    {
        $rules = [
            'pais' => 'required|string|max:255',
            'fecha_hora' => 'required|date',
            'exchange' => 'required|string|max:255',
            'estatus' => 'required|string|in:en proceso,cancelada,procesada',
        ];

        if ($this->activeTab == 'BUY') {
            $rules += [
                'moneda_comprada' => 'required|string|max:255',
                'precio_usd_comprado' => 'required|numeric',
                'precio_fiat_comprado' => 'required|numeric',
                'cantidad_fiat_comprado' => 'required|numeric',
            ];
        } else {
            $rules += [
                'moneda_vendida' => 'required|string|max:255',
                'precio_usd_vendido' => 'required|numeric',
                'precio_fiat_vendido' => 'required|numeric',
                'cantidad_fiat_vendido' => 'required|numeric',
            ];
        }

        $this->validate($rules);
    }

    private function createOrder()
    {
        if ($this->activeTab == 'BUY') {
            OrdenCompra::create([
                'pais' => $this->pais,
                'fecha_hora' => $this->fecha_hora,
                'exchange' => $this->exchange,
                'moneda_comprada' => $this->moneda_comprada,
                'precio_usd_comprado' => $this->precio_usd_comprado,
                'precio_fiat_comprado' => $this->precio_fiat_comprado,
                'cantidad_fiat_comprado' => $this->cantidad_fiat_comprado,
                'created_by' => auth()->user()->id,
                'estatus' => $this->estatus,
            ]);
        } else {
            OrdenVenta::create([
                'pais' => $this->pais,
                'fecha_hora' => $this->fecha_hora,
                'exchange' => $this->exchange,
                'moneda_vendida' => $this->moneda_vendida,
                'precio_usd_vendido' => $this->precio_usd_vendido,
                'precio_fiat_vendido' => $this->precio_fiat_vendido,
                'cantidad_fiat_vendido' => $this->cantidad_fiat_vendido,
                'created_by' => auth()->user()->id,
                'estatus' => $this->estatus,
            ]);
        }
    }
    private function updateOrder()
    {
        if ($this->activeTab == 'BUY') {
            $orden = OrdenCompra::findOrFail($this->ordenId);
            $orden->update([
                'pais' => $this->pais,
                'fecha_hora' => $this->fecha_hora,
                'exchange' => $this->exchange,
                'moneda_comprada' => $this->moneda_comprada,
                'precio_usd_comprado' => $this->precio_usd_comprado,
                'precio_fiat_comprado' => $this->precio_fiat_comprado,
                'cantidad_fiat_comprado' => $this->cantidad_fiat_comprado,
                'estatus' => $this->estatus,
            ]);
        } else {
            $orden = OrdenVenta::findOrFail($this->ordenId);
            $orden->update([
                'pais' => $this->pais,
                'fecha_hora' => $this->fecha_hora,
                'exchange' => $this->exchange,
                'moneda_vendida' => $this->moneda_vendida,
                'precio_usd_vendido' => $this->precio_usd_vendido,
                'precio_fiat_vendido' => $this->precio_fiat_vendido,
                'cantidad_fiat_vendido' => $this->cantidad_fiat_vendido,
                'estatus' => $this->estatus,
            ]);
        }
    }

    public function edit($id)
    {
        if ($this->activeTab == 'BUY') {
            $orden = OrdenCompra::findOrFail($id);
        } else {
            $orden = OrdenVenta::findOrFail($id);
        }

        $this->ordenId = $orden->id;
        $this->pais = $orden->pais;
        $this->fecha = $orden->fecha;
        $this->exchange = $orden->exchange;

        if ($this->activeTab == 'BUY') {
            $this->moneda_comprada = $orden->moneda_comprada;
            $this->precio_usd_comprado = $orden->precio_usd_comprado;
            $this->precio_fiat_comprado = $orden->precio_fiat_comprado;
            $this->cantidad_fiat_comprado = $orden->cantidad_fiat_comprado;
        } else {
            $this->moneda_vendida = $orden->moneda_vendida;
            $this->precio_usd_vendido = $orden->precio_usd_vendido;
            $this->precio_fiat_vendido = $orden->precio_fiat_vendido;
            $this->cantidad_fiat_vendido = $orden->cantidad_fiat_vendido;
        }

        $this->estatus = $orden->estatus;
    }

    public function delete($id)
    {
        if ($this->activeTab == 'BUY') {
            OrdenCompra::findOrFail($id)->delete();
        } else {
            OrdenVenta::findOrFail($id)->delete();
        }

        session()->flash('message', 'Orden eliminada exitosamente.');
    }

    public function updateStatus($id, $status)
    {
        if ($this->activeTab == 'BUY') {
            $orden = OrdenCompra::findOrFail($id);
        } else {
            $orden = OrdenVenta::findOrFail($id);
        }

        $orden->estatus = $status;
        $orden->save();

        session()->flash('message', 'Estatus de la orden actualizado exitosamente.');
    }

    public function filtrar()
    {
        // Este método puede ser utilizado para aplicar
        // Este método puede ser utilizado para aplicar lógica adicional de filtrado
        // Si ya estás utilizando los `when` en las consultas, puede que no necesites hacer nada aquí
    }

    public function resetFilters()
    {
        $this->searchFecha = null;
        $this->searchExchange = null;
    }
}
