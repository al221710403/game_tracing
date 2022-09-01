<x-modal wire:model="showEditGame" maxWidth="md" label="true">
    <x-slot name="title">
        Editar nuevo juego
    </x-slot>

    <x-slot name="content">

        <div class="mt-4">
            <div class="relative z-0 mb-6 w-full group">
                <input disabled wire:model.defer="name" type="text" name="name" id="name_game" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required="">
                <label for="name_game" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 required">Nombre del juego</label>
                @error('name') <span class="text-red-500 text-sm">{{ $message}}</span>@enderror
            </div>
            <div class="relative z-0 mb-6 w-full group">
                <textarea wire:model.defer="description" id="description" name="description" rows="2" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "></textarea>
                <label for="description" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Descripción</label>
                @error('description') <span class="text-red-500 text-sm">{{ $message}}</span>@enderror
            </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 mb-6 w-full group">
                    <input accept="image/*" wire:model.defer="backgroundImage" type="file" name="image" id="background_image" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" ">
                    <label for="background_image" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Imagen</label>
                    @error('backgroundImage') <span class="text-red-500 text-sm">{{ $message}}</span>@enderror
                </div>
                <div class="relative z-0 mb-6 w-full group">
                    <input wire:model.defer="siteGame" type="text" name="site" id="site_game" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" ">
                    <label for="site_game" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Sitio del juego</label>
                    @error('siteGame') <span class="text-red-500 text-sm">{{ $message}}</span>@enderror
                </div>
            </div>
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="mb-6 w-full group">
                    <label for="status" class="text-gray-500 block mb-2 text-sm font-medium required">Seleccione un estado</label>
                    <select wire:model.defer="statusId" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required="">
                        <option value="Elegir" disabled> Elige un estado</option>
                        @foreach($statuses as $status)
                            <option value="{{$status->id}}">{{$status->status}}</option>
                        @endforeach
                    </select>
                    @error('statusId') <span class="text-red-500 text-sm">{{ $message}}</span>@enderror
                </div>
                <div class="mb-6 w-full group">
                    <label for="game_engine" class="text-gray-500 block mb-2 text-sm font-medium required">Seleccione el motor de juego</label>
                    <select wire:model.defer="gameEngineId" id="game_engine" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required="">
                        <option value="Elegir" disabled> Elige un motor de juego</option>
                        @foreach($game_engines as $engine)
                            <option value="{{$engine->id}}">{{$engine->name}}</option>
                        @endforeach
                    </select>
                    @error('gameEngineId') <span class="text-red-500 text-sm">{{ $message}}</span>@enderror
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <button wire:click.prevent="updateGame()" type="button" class="mr-0 md:mr-2 mt-2 md:mt-0 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Guardar
        </button>
        <button wire:click="$set('showEditGame', false)" @click="show = false" type="button" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-400 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-500 focus:ring focus:ring-red-300 focus:ring-opacity-50">
            Cancelar
        </button>
    </x-slot>
</x-modal.modal-lg>
