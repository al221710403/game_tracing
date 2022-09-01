<x-modal wire:model="help" maxWidth="sm">
    <x-slot name="title">
        Información sobre el control de versiones
    </x-slot>

    <x-slot name="content">
        Contenido del control de versiones
    </x-slot>

    <x-slot name="footer">
        <button wire:click="$set('help', false)" @click="show = false" type="button" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-red-400 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-500 focus:ring focus:ring-red-300 focus:ring-opacity-50">
            Cerrar
        </button>
    </x-slot>
</x-modal.modal-lg>
