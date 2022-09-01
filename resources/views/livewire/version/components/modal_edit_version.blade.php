<x-modal wire:model="modal_version_edit" maxWidth="md" label="true" close="resetUI()">
    <x-slot name="title">
        Editar punto de control
    </x-slot>

    <x-slot name="content">
        <div class="mt-4">
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 mb-6 w-full group">
                    <input wire:model.defer="version" type="text" version="name" id="version_game" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                    <label for="version_game" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 required">Nombre de la versión</label>
                    @error('version') <span class="text-red-500 text-sm">{{ $message}}</span>@enderror
                </div>
                <div class="mb-6 w-full group">
                    <select wire:model.defer="statusId" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " required="">
                        <option value="Elegir" disabled> Elige un estado</option>
                        @foreach($statuses as $status)
                            <option value="{{$status->id}}">{{$status->status}}</option>
                        @endforeach
                    </select>
                    @error('statusId') <span class="text-red-500 text-sm">{{ $message}}</span>@enderror
                </div>
            </div>
            <div class="relative z-0 mb-6 w-full group">
                <textarea wire:model.defer="comment" id="comment" name="comment" rows="2" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer"></textarea>
                <label for="comment" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Comentario</label>
                @error('comment') <span class="text-red-500 text-sm">{{ $message}}</span>@enderror
            </div>

            <div class="relative z-0 mb-6 w-full group">
                <input wire:model.defer="file" type="file" name="image" id="files_version_edit" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  focus:outline-none focus:ring-0 focus:border-blue-600 peer" webkitdirectory multiple>
                <label for="files_version" class="peer-focus:font-medium absolute text-sm text-gray-500  duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Archivos de guaradado</label>
                @error('file') <span class="text-red-500 text-sm">{{ $message}}</span>@enderror
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <button wire:click.prevent="Update()" type="button" class="mr-0 md:mr-2 mt-2 md:mt-0 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Guardar
        </button>
        <button wire:click="resetUI()" @click="show = false" type="button" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-400 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-500 focus:ring focus:ring-red-300 focus:ring-opacity-50">
            Cancelar
        </button>
    </x-slot>
</x-modal.modal-lg>
