<div>
    <div class="flex justify-between items-center pb-4 bg-white">
        {{--  Buscador de juegos  --}}
        <div class="relative">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <span class="w-5 h-5 text-gray-500">
                    <i class='bx bx-search'></i>
                </span>
            </div>
            <input wire:model="search" type="text" class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-gray-500 focus:border-gray-500" placeholder="Buscar juego">
        </div>

        {{--  Boton de agregar  --}}
        <button title="Agregar juego" wire:click="$set('show', true)" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-2 focus:outline-none font-medium rounded-full text-sm px-5 py-2.5 text-center inline-flex items-center mr-2">
            <span class="mr-2 -ml-1 w-5 h-5 text-lg"><i class='bx bxs-add-to-queue'></i></span>
            Agregar
        </button>
    </div>
    {{--  Juegos para plaforma de juego  --}}
    <article class="my-2">
        <div @if ($games->count() > 0) class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3" @endif>
            @forelse ($games as $item)
                <x-card-normal :item="$item" />
            @empty
                <div class="flex flex-col items-center justify-center">
                    <h3>No hay juegos</h3>
                    <p>No has registrado ningún juego o no se ha encontrado ningún juego. Agrega uno con el botón
                        <span class="text-lg mx-2">
                            <i class='bx bxs-add-to-queue'></i>
                        </span>
                        de la esquina superior.
                    </p>
                </div>
            @endforelse
        </div>
    </article>
</div>
