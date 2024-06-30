<div>
    <x-app-layout>
        <div class="breadcrumb mb-4">
            <p class="text-sm text-gray-500"><span class="mr-2">Pages</span> / <span class="text-white ml-2">Lista Negra</span></p>
            <h1 class="text-xl font-semibold my-2">Lista Negra</h1>
        </div>
        <!-- Dynamic Content -->
        <div class="content">
            <div class="order-table w-[320px] sm:w-full mx-auto mt-16 p-6 bg-secondaryBg rounded-2xl">
                <!-- Green Header -->
                <div class="p-4 relative z-[5px] -top-10 flex bg-table-header-gradient justify-between items-center">
                    <h1 class="text-base sm:text-xl font-medium">LIsta Negra</h1>
                    <button class="text-sm sm:text-base bg-[#2A9D2F] hover:bg-green-700 text-white font-medium py-2 px-4 rounded" data-bs-toggle="modal" data-bs-target="#modalCrear">
                        Crear tabla
                    </button>
                </div>
                <!-- Search Filter -->
                <div class="flex flex-col md:flex-row mb-7 space-y-2 md:space-y-0 space-x-0 md:space-x-4 text-sm">
                    <select class="bg-primaryBg border border-brand text-white focus:outline-none focus:border-brand py-2 px-4 rounded-lg cursor-pointer w-full" wire:model="searchPais">
                        <option value="">Seleccione País</option>
                        @foreach($paises as $pais)
                            <option value="{{ $pais }}">{{ $pais }}</option>
                        @endforeach
                    </select>
                    <input type="date" class="bg-primaryBg border border-brand focus:outline-none focus:outline-none text-white py-2 px-4 rounded-lg w-full" wire:model="searchFecha">
                    <input type="text" placeholder="Buscar por forma de pago" class="bg-primaryBg border border-brand focus:outline-none text-white py-2 px-4 rounded-lg w-full" wire:model="searchExchange">
                    <button class="w-full sm:w-3/4 bg-primaryBg hover:bg-brand border border-brand text-white font-bold py-2 px-4 rounded-lg flex items-center justify-between" wire:click="filtrar">
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill="white" d="M10.0001 14.0667C10.0334 14.3167 9.95011 14.5833 9.75844 14.7583C9.68135 14.8356 9.58977 14.8969 9.48896 14.9387C9.38815 14.9805 9.28008 15.002 9.17094 15.002C9.0618 15.002 8.95373 14.9805 8.85292 14.9387C8.75211 14.8969 8.66054 14.8356 8.58344 14.7583L5.24178 11.4167C5.15094 11.3278 5.08187 11.2191 5.03995 11.0991C4.99803 10.9792 4.98439 10.8511 5.00011 10.725V6.45833L1.00844 1.35C0.873116 1.17628 0.812054 0.956048 0.838599 0.737442C0.865144 0.518835 0.977138 0.319622 1.15011 0.183333C1.30844 0.0666667 1.48344 0 1.66678 0H13.3334C13.5168 0 13.6918 0.0666667 13.8501 0.183333C14.0231 0.319622 14.1351 0.518835 14.1616 0.737442C14.1882 0.956048 14.1271 1.17628 13.9918 1.35L10.0001 6.45833V14.0667ZM3.36678 1.66667L6.66678 5.88333V10.4833L8.33344 12.15V5.875L11.6334 1.66667H3.36678Z"/>
                        </svg>                                
                        <span class="ml-2">Aplicar filtros</span>
                    </button>
                    <button class="w-full sm:w-3/4 bg-secondaryBg hover:bg-brand border border-brand text-white font-bold py-2 px-4 rounded-lg flex items-center justify-between" wire:click="resetFilters">
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill="white" d="M7.5 0C3.35786 0 0 3.35786 0 7.5C0 11.6421 3.35786 15 7.5 15C11.6421 15 15 11.6421 15 7.5C15 3.35786 11.6421 0 7.5 0ZM7.5 13.75C4.46243 13.75 2 11.2876 2 8.25C2 7.83579 2.33579 7.5 2.75 7.5C3.16421 7.5 3.5 7.83579 3.5 8.25C3.5 10.3211 5.17893 12 7.25 12C9.32107 12 11 10.3211 11 8.25C11 7.83579 11.3358 7.5 11.75 7.5C12.1642 7.5 12.5 7.83579 12.5 8.25C12.5 11.2876 10.0376 13.75 7.5 13.75ZM9 7.5C9 6.67157 8.32843 6 7.5 6C6.67157 6 6 6.67157 6 7.5C6 8.32843 6.67157 9 7.5 9C8.32843 9 9 8.32843 9 7.5ZM7.5 8.5C6.94772 8.5 6.5 8.05228 6.5 7.5C6.5 6.94772 6.94772 6.5 7.5 6.5C8.05228 6.5 8.5 6.94772 8.5 7.5C8.5 8.05228 8.05228 8.5 7.5 8.5Z"/>
                        </svg>                                
                        <span class="ml-2">Restablecer filtros</span>
                    </button>
                </div>
                <!-- Main Table -->
                <div class="overflow-x-auto w-full mb-3 text-sm sm:text-base">
                    <table class="min-w-[500%] sm:min-w-[300%] md:min-w-[200%] rounded-lg">
                        <thead class="bg-primaryBg">
                            <tr class="flex p-2">
                                <th class="py-2 w-full text-left">Nombre</th>
                                <th class="py-2 w-full text-left">Sexo</th>
                                <th class="py-2 w-full text-left">Nick Exchange</th>
                                <th class="py-2 w-full text-left">Fecha</th>
                                <th class="py-2 w-full text-left">País</th>
                                <th class="py-2 w-full text-left">Forma de Pago</th>
                                <th class="py-2 w-full text-left">Número de Referencia</th>
                                <th class="py-2 w-full text-left">Número de Orden Exchange</th>
                                <th class="py-2 w-full text-left">Descripción</th>
                                <th class="py-2 w-full text-left">Imagen</th>
                                <th class="py-2 w-full text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blacklist as $entry)
                            <tr class="border-t border-[#09BE8B] flex p-2">
                                <td class="py-2 w-full">{{ $entry->nombre }}</td>
                                <td class="py-2 w-full">{{ $entry->sexo }}</td>
                                <td class="py-2 w-full">{{ $entry->nickexchange }}</td>
                                <td class="py-2 w-full">{{ $entry->fecha }}</td>
                                <td class="py-2 w-full">{{ $entry->pais }}</td>
                                <td class="py-2 w-full">{{ $entry->forma_pago }}</td>
                                <td class="py-2 w-full">{{ $entry->numero_referencia }}</td>
                                <td class="py-2 w-full">{{ $entry->numero_orden_exchange }}</td>
                                <td class="py-2 w-full">{{ $entry->descripcion }}</td>
                                <td class="py-2 w-full">
                                    @if ($entry->imagen)
                                        <img src="{{ Storage::url($entry->imagen) }}" alt="Imagen" width="50">
                                    @endif
                                </td>
                                <td class="py-2 w-full">
                                    @if ($entry->user_id === Auth::id())
                                        <button class="flex-grow px-3 py-1 mr-2 text-sm text-white border border-[#31AF36] rounded hover:bg-[#31AF36]" wire:click="edit({{ $entry->id }})" data-bs-toggle="modal" data-bs-target="#modalCrear">
                                            Editar
                                        </button>
                                        <button class="flex-grow px-3 py-1 mr-2 text-sm text-white border border-[#FF0000] rounded hover:bg-[#FF0000]" wire:click="delete({{ $entry->id }})">
                                            Eliminar
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Paginación para la lista negra -->
                {{$blacklist->links()}}
            </div>
    
            <!-- Modal -->
<div wire:ignore.self class="fixed z-10 inset-0 overflow-y-auto hidden" id="modalCrear" aria-labelledby="modalCrearLabel" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
        <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="h-6 w-6 text-green-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modalCrearLabel">
                        Crear/Editar Entrada en la Lista Negra
                    </h3>
                    <div class="mt-2">
                        <div class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                            <div class="col-span-1">
                                <div class="form-group">
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                                    <input type="text" class="form-input mt-1 block w-full @error('nombre') is-invalid @enderror" id="nombre" wire:model="nombre">
                                    @error('nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="sexo" class="block text-sm font-medium text-gray-700">Sexo</label>
                                    <select class="form-select mt-1 block w-full @error('sexo') is-invalid @enderror" id="sexo" wire:model="sexo">
                                        <option value="">Seleccione</option>
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                    @error('sexo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nickexchange" class="block text-sm font-medium text-gray-700">Nick Exchange</label>
                                    <input type="text" class="form-input mt-1 block w-full @error('nickexchange') is-invalid @enderror" id="nickexchange" wire:model="nickexchange">
                                    @error('nickexchange') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                                    <input type="date" class="form-input mt-1 block w-full @error('fecha') is-invalid @enderror" id="fecha" wire:model="fecha">
                                    @error('fecha') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pais" class="block text-sm font-medium text-gray-700">País</label>
                                    <select class="form-select mt-1 block w-full @error('pais') is-invalid @enderror" id="pais" wire:model="pais">
                                        <option value="">Seleccione</option>
                                        @foreach($paises as $pais)
                                            <option value="{{ $pais }}">{{ $pais }}</option>
                                        @endforeach
                                    </select>
                                    @error('pais') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="forma_pago" class="block text-sm font-medium text-gray-700">Forma de Pago</label>
                                    <input type="text" class="form-input mt-1 block w-full @error('forma_pago') is-invalid @enderror" id="forma_pago" wire:model="forma_pago">
                                    @error('forma_pago') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen</label>
                                    <input type="file" class="form-input mt-1 block w-full @error('imagen') is-invalid @enderror" id="imagen" wire:model="imagen">
                                    @error('imagen') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    @if ($imagen instanceof \Livewire\TemporaryUploadedFile)
                                        <img src="{{ $imagen->temporaryUrl() }}" alt="Preview" width="100">
                                    @elseif (is_string($imagen))
                                        <img src="{{ Storage::url($imagen) }}" alt="Imagen Actual" width="100">
                                    @endif
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="form-group">
                                    <label for="numero_referencia" class="block text-sm font-medium text-gray-700">Número de Referencia</label>
                                    <input type="text" class="form-input mt-1 block w-full @error('numero_referencia') is-invalid @enderror" id="numero_referencia" wire:model="numero_referencia">
                                    @error('numero_referencia') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="numero_orden_exchange" class="block text-sm font-medium text-gray-700">Número de Orden Exchange</label>
                                    <input type="text" class="form-input mt-1 block w-full @error('numero_orden_exchange') is-invalid @enderror" id="numero_orden_exchange" wire:model="numero_orden_exchange">
                                    @error('numero_orden_exchange') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                                    <textarea class="form-input mt-1 block w-full @error('descripcion') is-invalid @enderror" id="descripcion" wire:model="descripcion"></textarea>
                                    @error('descripcion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                    <button type="button"
                        class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-blue-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5" wire:click="store">
                        Guardar
                    </button>
                </span>
                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                    <button type="button"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5" onclick="closeModal()">
                        Cancelar
                    </button>
                </span>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<script>
    function openModal() {
        document.getElementById('modalCrear').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modalCrear').classList.add('hidden');
    }

    window.addEventListener('ordenStore', () => {
        closeModal();
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

    </x-app-layout>
    
</div>