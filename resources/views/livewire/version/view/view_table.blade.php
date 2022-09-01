<div class="overflow-x-auto relative">
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

    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-200">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Nombre
                </th>
                <th scope="col" class="py-3 px-6 w-1/6">
                    Descripción
                </th>
                <th scope="col" class="py-3 px-6">
                    Sitio de descarga
                </th>
                <th scope="col" class="py-3 px-6">
                    Motor de juego
                </th>
                <th scope="col" class="py-3 px-6">
                    Estado
                </th>
                <th scope="col" class="py-3 px-6">
                    Acción
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($games as $game)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="py-4 px-6 flex">
                        {{--  <img class="w-10 h-10 rounded-lg mr-2" src="{{ asset('storage/'.$game->image) }}" alt="$game->name">  --}}
                        <span>{{$game->name}}</span>
                    </td>

                    <td class="py-4 px-6 w-1/6">
                        <p style="word-wrap: break-word;">{{Str::limit($game->description, 150)}}</p>
                    </td>

                    <td class="py-4 px-6">
                        <a href="{{$game->download_site}}" target="_blank" class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline">Sitio de descarga <span class="ml-2"><i class='bx bx-right-arrow-alt'></i></span></a>
                    </td>

                    <td class="py-4 px-6">
                        <span class="bg-gray-300 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded mr-2">
                            <span class="mr-1 w-3 h-3">
                                <i class='bx bxs-component'></i>
                            </span>
                            {{$game->game_engine->name}}
                        </span>
                    </td>

                    <td class="py-4 px-6">
                        <div class="flex items-center">
                            <div class="h-2.5 w-2.5 rounded-full bg-{{$game->status->color}}-400 mr-2"></div> {{$game->status->status}}
                        </div>
                    </td>

                    <td class="py-4 px-6">
                        <ul class="flex text-2xl text-gray-700">
                            <li class="mr-1">
                                <a href="{{ route('version.show.game', $game->id) }}" class="hover:text-blue-600" title="Ver">
                                    <i class='bx bxs-log-in-circle'></i>
                                </a>
                            </li>
                            <li class="mr-1">
                                <button wire:click="editGame({{$game->id}})" class="hover:text-green-600" title="Editar">
                                    <i class='bx bxs-edit-alt'></i>
                                </button>
                            </li>
                            <li class="mr-1">
                                <button onclick="Confirm('el juego','deleteGame',{{$game->id}})" class="hover:text-red-600" title="Eliminar">
                                    <i class='bx bxs-trash'></i>
                                </button>
                            </li>
                        </ul>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="pt-3 text-center">
                        <h3>No hay juegos</h3>
                        <p>No has registrado ningún juego o no se ha encontrado ningún juego. Agrega uno con el botón
                            <span class="text-lg mx-2">
                                <i class='bx bxs-add-to-queue'></i>
                            </span>
                            de la esquina superior.
                        </p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
