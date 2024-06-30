<?php

namespace App\Livewire\Components\BlackList;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Blacklist as BlacklistModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;

class BlackList extends Component
{
    use WithPagination, WithFileUploads;

    public $nombre, $sexo, $nickexchange, $fecha, $pais, $forma_pago, $numero_referencia, $numero_orden_exchange, $descripcion, $imagen, $entryId;
    public $searchFecha, $searchExchange, $searchPais;
    public $paises = [
        'Argentina', 'Bolivia', 'Brasil', 'Chile', 'Colombia', 'Costa Rica', 'Cuba', 'Ecuador', 'El Salvador', 'Guatemala', 'Honduras', 'México', 'Nicaragua', 'Panamá', 'Paraguay', 'Perú', 'Puerto Rico', 'República Dominicana', 'Uruguay', 'Venezuela'
    ];

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'sexo' => 'required|string|max:255',
        'nickexchange' => 'nullable|string|max:255',
        'fecha' => 'required|date',
        'pais' => 'required|string|max:255',
        'forma_pago' => 'required|string|max:255',
        'numero_referencia' => 'required|string|max:255',
        'numero_orden_exchange' => 'nullable|string|max:255',
        'descripcion' => 'required|string|max:1000',
        'imagen' => 'nullable|image|max:1024', // 1MB Max
    ];

    public function render()
    {
        $query = BlacklistModel::query();

        if ($this->searchFecha) {
            $query->whereDate('fecha', $this->searchFecha);
        }

        if ($this->searchExchange) {
            $query->where('forma_pago', 'like', '%' . $this->searchExchange . '%');
        }

        if ($this->searchPais) {
            $query->where('pais', $this->searchPais);
        }

        $blacklist = $query->paginate(10);

        return view('livewire.components.black-list.black-list', compact('blacklist'));
    }

    public function store()
    {
        $this->validate();

        $data = [
            'nombre' => $this->nombre,
            'sexo' => $this->sexo,
            'nickexchange' => $this->nickexchange,
            'fecha' => $this->fecha,
            'pais' => $this->pais,
            'forma_pago' => $this->forma_pago,
            'numero_referencia' => $this->numero_referencia,
            'numero_orden_exchange' => $this->numero_orden_exchange,
            'descripcion' => $this->descripcion,
            'user_id' => Auth::id(),
        ];

        if ($this->imagen instanceof UploadedFile) {
            $data['imagen'] = $this->imagen->store('images', 'public');
        } elseif (is_string($this->imagen)) {
            $data['imagen'] = $this->imagen;
        }

        BlacklistModel::updateOrCreate(['id' => $this->entryId], $data);

        $this->resetInputFields();
        $this->dispatchBrowserEvent('ordenStore'); // Emitir evento para cerrar modal
    }

    public function edit($id)
    {
        $entry = BlacklistModel::findOrFail($id);
        if ($entry->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $this->entryId = $entry->id;
        $this->nombre = $entry->nombre;
        $this->sexo = $entry->sexo;
        $this->nickexchange = $entry->nickexchange;
        $this->fecha = $entry->fecha;
        $this->pais = $entry->pais;
        $this->forma_pago = $entry->forma_pago;
        $this->numero_referencia = $entry->numero_referencia;
        $this->numero_orden_exchange = $entry->numero_orden_exchange;
        $this->descripcion = $entry->descripcion;
        $this->imagen = $entry->imagen;
    }

    public function delete($id)
    {
        $entry = BlacklistModel::findOrFail($id);
        if ($entry->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $entry->delete();
    }

    public function resetInputFields()
    {
        $this->nombre = '';
        $this->sexo = '';
        $this->nickexchange = '';
        $this->fecha = '';
        $this->pais = '';
        $this->forma_pago = '';
        $this->numero_referencia = '';
        $this->numero_orden_exchange = '';
        $this->descripcion = '';
        $this->imagen = null;
        $this->entryId = null;
    }

    public function filtrar()
    {
        // Lógica para filtrar, ya manejada en el método render
    }

    public function resetFilters()
    {
        $this->reset(['searchFecha', 'searchExchange', 'searchPais']);
    }
}
