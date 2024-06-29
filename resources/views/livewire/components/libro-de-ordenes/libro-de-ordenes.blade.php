<div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                            <h6 class="text-white text-capitalize ps-3">Libro de Órdenes</h6>
                            <div>
                                <button class="btn btn-light me-3 btn-sm" data-bs-toggle="modal" data-bs-target="#modalCrear">
                                    <i class="bi bi-plus bi-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link @if($activeTab == 'BUY') active @endif" id="buy-tab" data-bs-toggle="tab" data-bs-target="#buy-tab-pane" type="button" role="tab" aria-controls="buy-tab-pane" aria-selected="true" wire:click="switchTab('BUY')">Órdenes de Compra</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link @if($activeTab == 'SELL') active @endif" id="sell-tab" data-bs-toggle="tab" data-bs-target="#sell-tab-pane" type="button" role="tab" aria-controls="sell-tab-pane" aria-selected="false" wire:click="switchTab('SELL')">Órdenes de Venta</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <!-- Filtros -->
                                <div class="d-flex justify-content-between p-3">
                                    <div class="form-group">
                                        <label for="searchFecha">Fecha</label>
                                        <input type="date" class="form-control" id="searchFecha" wire:model="searchFecha">
                                    </div>
                                    <div class="form-group">
                                        <label for="searchExchange">Exchange</label>
                                        <input type="text" class="form-control" id="searchExchange" wire:model="searchExchange">
                                    </div>
                                    <div>
                                        <button class="btn btn-primary btn-sm" wire:click="filtrar">
                                            <i class="bi bi-filter bi-lg"></i>
                                        </button>
                                        <button class="btn btn-secondary btn-sm" wire:click="resetFilters">
                                            <i class="bi bi-arrow-counterclockwise bi-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- Tabla de órdenes de compra -->
                                <div class="tab-pane fade @if($activeTab == 'BUY') show active @endif" id="buy-tab-pane" role="tabpanel" aria-labelledby="buy-tab" tabindex="0">
                                    <table class="table align-items-center mb-0 table-sm" style="font-size: 14px;">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">País</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Fecha</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Exchange</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Moneda</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Precio USD</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Precio Fiat</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Cantidad Fiat</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Estatus</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($ordenesCompra as $orden)
                                            <tr>
                                                <td class="text-xs font-weight-bold">{{ $orden->pais }}</td>
                                                <td class="text-xs font-weight-bold">{{ $orden->fecha_hora }}</td>
                                                <td class="text-xs font-weight-bold">{{ $orden->exchange }}</td>
                                                <td class="text-xs font-weight-bold">{{ $orden->moneda_comprada }}</td>
                                                <td class="text-xs font-weight-bold">{{ $orden->precio_usd_comprado }}</td>
                                                <td class="text-xs font-weight-bold">{{ $orden->precio_fiat_comprado }}</td>
                                                <td class="text-xs font-weight-bold">{{ $orden->cantidad_fiat_comprado }}</td>
                                                <td class="text-xs font-weight-bold">
                                                    <span class="badge bg-{{ $orden->estatus == 'procesada' ? 'success' : ($orden->estatus == 'cancelada' ? 'danger' : 'primary') }}">
                                                        {{ $orden->estatus }}
                                                    </span>
                                                </td>
                                                <td class="text-xs font-weight-bold">
                                                    <button class="btn btn-info btn-sm" wire:click="edit({{ $orden->id }})" data-bs-toggle="modal" data-bs-target="#modalCrear">
                                                        <i class="bi bi-pencil bi-lg"></i>
                                                    </button>
                                                </td>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- Paginación para órdenes de compra -->
                                    {{$ordenesCompra->links()}}
                                </div>
                                <!-- Tabla de órdenes de venta -->
                                <div class="tab-pane fade @if($activeTab == 'SELL') show active @endif" id="sell-tab-pane" role="tabpanel" aria-labelledby="sell-tab" tabindex="0">
                                    <table class="table align-items-center mb-0 table-sm" style="font-size: 14px;">
                                        <thead>
                                            <tr>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">País</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Fecha</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Exchange</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Moneda</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Precio USD</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Precio Fiat</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Cantidad Fiat</th>
                                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Estatus</th>
                                                <th class="text-secondary opacity-7"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($ordenesVenta as $orden)
                                            <tr>
                                                <td class="text-xs font-weight-bold">{{ $orden->pais }}</td>
                                                <td class="text-xs font-weight-bold">{{ $orden->fecha_hora }}</td>
                                                <td class="text-xs font-weight-bold">{{ $orden->exchange }}</td>
                                                <td class="text-xs font-weight-bold">{{ $orden->moneda_vendida }}</td>
                                                <td class="text-xs font-weight-bold">{{ $orden->precio_usd_vendido }}</td>
                                                <td class="text-xs font-weight-bold">{{ $orden->precio_fiat_vendido }}</td>
                                                <td class="text-xs font-weight-bold">{{ $orden->cantidad_fiat_vendido }}</td>
                                                <td class="text-xs font-weight-bold">
                                                    <span class="badge bg-{{ $orden->estatus == 'procesada' ? 'success' : ($orden->estatus == 'cancelada' ? 'danger' : 'primary') }}">
                                                        {{ $orden->estatus }}
                                                    </span>
                                                </td>
                                                <td class="text-xs font-weight-bold">
                                                    <button class="btn btn-info btn-sm" wire:click="edit({{ $orden->id }})" data-bs-toggle="modal" data-bs-target="#modalCrear">
                                                        <i class="bi bi-pencil bi-lg"></i>
                                                    </button>
                                                </td>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- Paginación para órdenes de venta -->
                                    {{$ordenesVenta->links()}}
                                </div>
                            </div>
                            <!-- Modal -->
                            <div wire:ignore.self class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="modalCrearLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalCrearLabel">Crear/Editar Orden</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="pais">País</label>
                                                        <input type="text" class="form-control @error('pais') is-invalid @enderror" id="pais" wire:model="pais">
                                                        @error('pais') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fecha_hora">Fecha y Hora</label>
                                                        <input type="datetime-local" class="form-control @error('fecha_hora') is-invalid @enderror" id="fecha_hora" wire:model="fecha_hora">
                                                        @error('fecha_hora') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exchange">Exchange</label>
                                                        <select class="form-select @error('exchange') is-invalid @enderror" id="exchange" wire:model="exchange">
                                                            <option value="">Seleccione</option>
                                                            <option value="Binance">Binance</option>
                                                            <option value="Okex">Okex</option>
                                                            <option value="Kucoin">Kucoin</option>
                                                        </select>
                                                        @error('exchange') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="estatus">Estatus</label>
                                                        <select class="form-select @error('estatus') is-invalid @enderror" id="estatus" wire:model="estatus">
                                                            <option value="">Seleccione</option>
                                                            <option value="en proceso">En Proceso</option>
                                                            <option value="cancelada">Cancelada</option>
                                                            <option value="procesada">Procesada</option>
                                                        </select>
                                                        @error('estatus') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Segunda sección -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="moneda_comprada">Moneda Comprada</label>
                                                        <input type="text" class="form-control @error('moneda_comprada') is-invalid @enderror" id="moneda_comprada" wire:model="moneda_comprada">
                                                        @error('moneda_comprada') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="precio_usd_comprado">Precio USD Comprado</label>
                                                        <input type="number" class="form-control @error('precio_usd_comprado') is-invalid @enderror" id="precio_usd_comprado" wire:model="precio_usd_comprado">
                                                        @error('precio_usd_comprado') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="precio_fiat_comprado">Precio Fiat Comprado</label>
                                                        <input type="number" class="form-control @error('precio_fiat_comprado') is-invalid @enderror" id="precio_fiat_comprado" wire:model="precio_fiat_comprado">
                                                        @error('precio_fiat_comprado') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="cantidad_fiat_comprado">Cantidad Fiat Comprado</label>
                                                        <input type="number" class="form-control @error('cantidad_fiat_comprado') is-invalid @enderror" id="cantidad_fiat_comprado" wire:model="cantidad_fiat_comprado">
                                                        @error('cantidad_fiat_comprado') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Más secciones si es necesario -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                                                <i class="bi bi-x bi-lg"></i>
                                            </button>
                                            <button type="button" class="btn btn-primary btn-sm" wire:click="store">
                                                <i class="bi bi-save bi-lg"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin del Modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('ordenStore', () => {
            var myModalEl = document.getElementById('modalCrear');
            var modal = bootstrap.Modal.getInstance(myModalEl);
            modal.hide();
            limpiarModal(); // Limpia los campos del modal
        });

        function limpiarModal() {
            var modalForm = document.getElementById('modalCrear').querySelector('form');
            if (modalForm) {
                modalForm.reset(); // Resetea el formulario del modal
            }
        }

        document.addEventListener("livewire:load", () => {
            Livewire.on('ordenCreada', () => {
                limpiarModal(); // Limpia los campos del modal al crear una orden
            });
        });
    </script>
</div>
