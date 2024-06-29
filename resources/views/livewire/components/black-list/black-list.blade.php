<div>
    <style>
        .image-hover {
            position: relative;
            display: inline-block;
        }

        .image-hover img {
            transition: transform 0.3s ease;
        }

        .image-hover:hover img {
            transform: scale(5); /* Ajusta el valor de scale según el tamaño deseado */
            z-index: 10;
            position: relative;
        }
    </style>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                            <h6 class="text-white text-capitalize ps-3">BlackList</h6>
                            <div>
                                <button class="btn btn-light me-3 btn-sm" data-bs-toggle="modal" data-bs-target="#modalCrear">
                                    <i class="bi bi-plus bi-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <!-- Filtros -->
                            <div class="d-flex justify-content-between p-3">
                                <div class="form-group">
                                    <label for="searchFecha">Fecha</label>
                                    <input type="date" class="form-control" id="searchFecha" wire:model="searchFecha">
                                </div>
                                <div class="form-group">
                                    <label for="searchExchange">Forma de Pago</label>
                                    <input type="text" class="form-control" id="searchExchange" wire:model="searchExchange">
                                </div>
                                <div class="form-group">
                                    <label for="searchPais">País</label>
                                    <select class="form-control" id="searchPais" wire:model="searchPais">
                                        <option value="">Seleccione</option>
                                        @foreach($paises as $pais)
                                            <option value="{{ $pais }}">{{ $pais }}</option>
                                        @endforeach
                                    </select>
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
                            <!-- Tabla de la lista negra -->
                            <table class="table align-items-center mb-0 table-sm" style="font-size: 14px;">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Sexo</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nick Exchange</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Fecha</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">País</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Forma de Pago</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Número de Referencia</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Número de Orden Exchange</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Descripción</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Imagen</th>
                                        <th class="text-secondary opacity-7">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blacklist as $entry)
                                    <tr>
                                        <td class="text-xs font-weight-bold">{{ $entry->nombre }}</td>
                                        <td class="text-xs font-weight-bold">{{ $entry->sexo }}</td>
                                        <td class="text-xs font-weight-bold">{{ $entry->nickexchange }}</td>
                                        <td class="text-xs font-weight-bold">{{ $entry->fecha }}</td>
                                        <td class="text-xs font-weight-bold">{{ $entry->pais }}</td>
                                        <td class="text-xs font-weight-bold">{{ $entry->forma_pago }}</td>
                                        <td class="text-xs font-weight-bold">{{ $entry->numero_referencia }}</td>
                                        <td class="text-xs font-weight-bold">{{ $entry->numero_orden_exchange }}</td>
                                        <td class="text-xs font-weight-bold">{{ $entry->descripcion }}</td>
                                        <td class="text-xs font-weight-bold image-hover">
                                            @if ($entry->imagen)
                                                <img src="{{ Storage::url($entry->imagen) }}" alt="Imagen" width="50">
                                            @endif
                                        </td>
                                        <td class="text-xs font-weight-bold">
                                            @if ($entry->user_id === Auth::id())
                                                <button class="btn btn-info btn-sm" wire:click="edit({{ $entry->id }})" data-bs-toggle="modal" data-bs-target="#modalCrear">
                                                    <i class="bi bi-pencil bi-lg"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm" wire:click="delete({{ $entry->id }})">
                                                    <i class="bi bi-trash bi-lg"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Paginación para la lista negra -->
                            {{$blacklist->links()}}
                        </div>
                        <!-- Modal -->
                        <div wire:ignore.self class="modal fade" id="modalCrear" tabindex="-1" role="dialog" aria-labelledby="modalCrearLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalCrearLabel">Crear/Editar Entrada en la Lista Negra</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nombre">Nombre</label>
                                                    <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" wire:model="nombre">
                                                    @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="sexo">Sexo</label>
                                                    <select class="form-control @error('sexo') is-invalid @enderror" id="sexo" wire:model="sexo">
                                                        <option value="">Seleccione</option>
                                                        <option value="Masculino">Masculino</option>
                                                        <option value="Femenino">Femenino</option>
                                                        <option value="Otro">Otro</option>
                                                    </select>
                                                    @error('sexo') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="nickexchange">Nick Exchange</label>
                                                    <input type="text" class="form-control @error('nickexchange') is-invalid @enderror" id="nickexchange" wire:model="nickexchange">
                                                    @error('nickexchange') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="fecha">Fecha</label>
                                                    <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha" wire:model="fecha">
                                                    @error('fecha') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="pais">País</label>
                                                    <select class="form-control @error('pais') is-invalid @enderror" id="pais" wire:model="pais">
                                                        <option value="">Seleccione</option>
                                                        @foreach($paises as $pais)
                                                            <option value="{{ $pais }}">{{ $pais }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('pais') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="forma_pago">Forma de Pago</label>
                                                    <input type="text" class="form-control @error('forma_pago') is-invalid @enderror" id="forma_pago" wire:model="forma_pago">
                                                    @error('forma_pago') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="imagen">Imagen</label>
                                                    <input type="file" class="form-control @error('imagen') is-invalid @enderror" id="imagen" wire:model="imagen">
                                                    @error('imagen') <span class="text-danger">{{ $message }}</span> @enderror
                                                    @if ($imagen instanceof \Livewire\TemporaryUploadedFile)
                                                        <img src="{{ $imagen->temporaryUrl() }}" alt="Preview" width="100">
                                                    @elseif (is_string($imagen))
                                                        <img src="{{ Storage::url($imagen) }}" alt="Imagen Actual" width="100">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="numero_referencia">Número de Referencia</label>
                                                    <input type="text" class="form-control @error('numero_referencia') is-invalid @enderror" id="numero_referencia" wire:model="numero_referencia">
                                                    @error('numero_referencia') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="numero_orden_exchange">Número de Orden Exchange</label>
                                                    <input type="text" class="form-control @error('numero_orden_exchange') is-invalid @enderror" id="numero_orden_exchange" wire:model="numero_orden_exchange">
                                                    @error('numero_orden_exchange') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="descripcion">Descripción</label>
                                                    <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" wire:model="descripcion"></textarea>
                                                    @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
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

    <script>
        window.addEventListener('ordenStore', () => {
            var myModalEl = document.getElementById('modalCrear');
            if (myModalEl) {
                var modal = bootstrap.Modal.getInstance(myModalEl);
                if (modal) {
                    modal.hide();
                }
                limpiarModal(); // Limpia los campos del modal
            }
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
