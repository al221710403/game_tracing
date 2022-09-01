@push('styles')
    <style>
        .content_items{
            display: grid;
            grid-template-columns: repeat(
                auto-fit,
                minmax(
                    150px,
                    1fr
                )
            );
        }
    </style>
    <style>
        .card--background__opacity{
            visibility: hidden;
        }

        .card-effect:hover .card--background__opacity{
            visibility: visible;
        }

        .card-effect:hover .card--background__zoom{
            transform: scale(1.3)
        }

        .item--zoom:hover{
            transform: scale(1.1)
        }

        .card--descripction{
            position: absolute;
            top: 0.25rem;
            /** left: 80%;
            height: 95%;**/
            visibility: hidden;
        }

        .card-effect:hover .card--descripction {
            opacity: 1;
            visibility: visible;
        }

    </style>
@endpush

<div class="min-h-full flex flex-col">
    {{--  Spinner  --}}
    <x-spinner/>

    {{--  Cabecera  --}}
    <header class="flex justify-between p-4 bg-white rounded-tr-xl rounded-br-xl shadow-lg">
        <h1 class="text-xl font-bold text-gray-700"> <span><i class='bx bxs-cabinet'></i></span> Control de versiones</h1>
        <ul class="flex text-xl text-gray-700">
            <li class="mr-3">
                @if ($view == 1)
                    <button wire:click="$set('view', 2)" class=" hover:text-indigo-700">
                        <i class='bx bx-left-indent'></i>
                    </button>
                @endif
                @if ($view == 2)
                    <button wire:click="$set('view', 1)" class=" hover:text-indigo-700">
                        <i class='bx bxs-category-alt'></i>
                    </button>
                @endif

            </li>
            <li>
                <button class="hover:text-indigo-700" wire:click="$set('help', true)" title="Información">
                    <i class='bx bxs-info-circle'></i>
                </button>
            </li>
        </ul>
    </header>

    {{--  Modal  --}}
    @include('livewire.version.components.modal_create')
    @include('livewire.version.components.modal_edit_game_index')
    @include('livewire.version.components.modal_help')

    {{--  Contenido  --}}
    <section class="mt-2 p-4 bg-white rounded-tr-xl rounded-br-xl shadow-lg min-h-full grow">

        @if ($view == 1)
            @include('livewire.version.view.view_item')
        @else
            @include('livewire.version.view.view_table')
        @endif

        {{$games->links()}}
    </section>
</div>

@push('scripts')
@endpush
