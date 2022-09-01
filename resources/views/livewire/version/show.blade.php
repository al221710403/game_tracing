@push('styles')
@endpush

<div class="min-h-full flex flex-col">
    {{--  Spinner  --}}
    <x-spinner/>

    {{--  Cabecera  --}}
    <header class="flex justify-between p-4 bg-white rounded-tr-xl rounded-br-xl shadow-lg">
        <h2 class="text-xl font-bold text-gray-700"> <span><i class='bx bxs-game'></i></span> Información del juego </h2>
        <ul class="flex text-2xl text-gray-700">
            <li class="mr-1">
                <button class="hover:text-green-500" wire:click="editGame()" title="Editar">
                    <i class='bx bxs-edit-alt'></i>
                </button>
            </li>
            <li class="mr-1">
                <button class="hover:text-red-500" onclick="Confirm('el juego','deleteGame',{{$game->id}})" title="Eliminar juego">
                    <i class='bx bxs-trash'></i>
                </button>
            </li>
            <li class="mr-1">
                <a href="{{ route('version') }}" class="hover:text-indigo-500" title="Regresar">
                    <i class='bx bxs-log-out-circle'></i>
                </a>
            </li>
            <li>
                <button class="hover:text-blue-500" wire:click="$set('help', true)" title="Información">
                    <i class='bx bxs-info-circle'></i>
                </button>
            </li>
        </ul>
    </header>

    {{--  Modal  --}}
    @include('livewire.version.components.modal_help_show_game')
    @include('livewire.version.components.modal_create_version')
    @include('livewire.version.components.modal_edit_version')
    @include('livewire.version.components.modal_edit_game')

    {{--  Contenido  --}}
    <section class="mt-2 rounded-tr-xl rounded-br-xl shadow-lg min-h-full grow">
        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-3">
            <section class="rounded-lg shadow-2xl bg-white">
                {{--  Cabezera del articulo  --}}
                <header class="bg-gray-50 rounded-tr-xl py-2 mb-1.5 text-gray-700 font-bold flex justify-between items-center px-3">
                    <h2 class="text-xl"> {{ $game->name }} </h2>
                    <time datetime=" {{$game->created_at}} " class="text-sm">
                        {{ Carbon\Carbon::parse($game->created_at)->isoFormat('D MMMM') }}
                        <i class='bx bxs-calendar'></i>
                    </time>
                </header>

                {{-- Portada --}}
                <div class="shadow-xl relative mb-11" x-data="{photoName: null, photoPreview: null, show: true}">
                    <input type="file" class="hidden"
                                    wire:model="photo"
                                    x-ref="photo"
                                    x-on:change="
                                            button = true;
                                            photoName = $refs.photo.files[0].name;
                                            const reader = new FileReader();
                                            reader.onload = (e) => {
                                                photoPreview = e.target.result;
                                            };
                                            reader.readAsDataURL($refs.photo.files[0]);
                                    "
                                    accept="image/*"
                    />

                    {{--  Mostrar foto  --}}
                    <div class="w-full h-80">
                        @if ($photo)
                            <img class="w-full h-full" src=" {{$photo->temporaryUrl()}} ">
                        @else
                            {{-- Foto actual --}}
                            <img class="w-full h-full" src="{{ asset('storage/'.$game->image) }}" alt="{{ $game->name }}">
                        @endif
                    </div>
                    @error('photo') <span class="text-red-500 text-sm">{{ $message}}</span>@enderror

                    {{-- Iconos flotantes de editar,me gusta y seguir --}}
                    <div class="absolute flex flex-col items-end top-5 right-4">
                        @if ($photo)
                            {{-- Guardar --}}
                            <button class=" hidden h-10 w-10 text-white rounded-full bg-blue-400 hover:bg-blue-600" title="Guaradr">
                                <i class='text-lg bx bx bxs-save'></i>
                            </button>

                            {{-- Guardar --}}
                            <button wire:click="savePhoto" class="mb-2 flex justify-center items-center h-10 w-10 text-white rounded-full bg-blue-400 hover:bg-blue-600" title="Guaradr">
                                <i class='text-lg bx bx bxs-save'></i>
                            </button>

                            {{-- Seguir cancelar --}}
                            <button  wire:click="$set('photo', '')" class="flex justify-center items-center h-10 w-10 text-white rounded-full bg-red-400 hover:bg-red-600" title="Cancelar">
                                <i class='text-lg bx bxs-x-circle'></i>
                            </button>
                        @else
                            {{-- Editar imagen --}}
                            <button x-on:click.prevent="$refs.photo.click()" class="rounded-full h-10 w-10 bg-yellow-400 opacity-80 hover:bg-yellow-600 hover:opacity-100 text-white mb-1.5" title="Editar imagen">
                                <i class='bx bxs-edit-alt'></i>
                            </button>
                        @endif
                    </div>

                    {{-- Etiqieta de estado --}}
                    <span class="absolute top-5 left-4 rounded-lg bg-{{$game->status->color}}-600 text-white text-bold px-1.5 py-1">
                        {{$game->status->status}}
                    </span>

                    {{-- Barra de abajo --}}
                    <div class="absolute inset-x-0 -bottom-8 h-14">
                        <div class="grid h-full grid-cols-2 mx-auto text-white rounded-full w-72 bg-black">
                            {{-- Calificación --}}
                            <div class="flex items-center justify-center leading-none text-center">
                                <div class="leading-1">
                                    <span class="text-base font-bold"> Calificación </span>
                                    <div class="text-xs">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $game->qualification)
                                                <button wire:click="like({{ $i+1 }})" class="text-yellow-400 hover:text-yellow-600">
                                                    <span><i class='bx bxs-star'></i></span>
                                                </button>
                                            @else
                                                <button wire:click="like({{ $i+1 }})" class="text-yellow-400 hover:text-yellow-600">
                                                    <span><i class='bx bx-star'></i></span>
                                                </button>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            {{-- Seguidores --}}
                            <div class="flex items-center justify-center leading-none text-center">
                                <span class="mr-2 text-2xl">
                                    <i class='bx bxs-package'></i>
                                </span>
                                <div class="leading-1">
                                    <span class="text-base font-bold"> {{$versions->count()}} </span>
                                    <p class="text-xs text-gray-300">Versiones</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--  Descripción  --}}
                <div class="mb-5 relative py-2 mr-10 text-gray-500 shadow-lg" x-data="{ open:false }">
                    {{-- Contenido --}}
                    <div class="border-l-4 border-blue-600 ml-6 pl-3.5 pr-6 my-6" >
                        <h2 class="text-lg font-semibold text-gray-600">Descripción</h2>

                        <div x-show="!open">
                            <p style="word-wrap: break-word;">{{$game->description}}</p>
                        </div>

                        <div x-cloak x-show="open">
                            <textarea rows="10" class="w-full" wire:model.defer="description"></textarea>
                        </div>
                    </div>

                    {{-- Botones --}}
                    <div class="absolute -top-3.5 -right-5 flex flex-col items-end justify-end">
                        {{-- Guardar descripción--}}
                        <button wire:click="saveDescription" x-on:click="open = false" class="rounded-full h-10 w-10 bg-blue-600 hover:bg-blue-800 text-white mb-2.5"
                                 x-show="open">
                                 <i class='bx bxs-save'></i>
                        </button>

                        {{-- Cancelar --}}
                        <button class="rounded-full h-10 w-10 bg-red-600 hover:bg-red-900 text-white mb-2.5"
                                x-on:click="open = false" x-show="open">
                                <i class='text-lg bx bxs-x-circle'></i>
                        </button>

                            @if($game->description != null)
                                <button class="rounded-full h-10 w-10 bg-green-600 hover:bg-green-800 text-white mb-2.5" title="Editar descripción" x-on:click="open = true" x-show="!open">
                                    <i class='bx bxs-edit-alt'></i>
                                </button>

                                {{--  Eliminar  --}}
                                <button onclick="Confirm('la descripción','deleteDescription')" class="rounded-full h-10 w-10 bg-red-600 hover:bg-red-800 text-white mb-2.5" title="Eliminar" x-show="!open">
                                    <i class='bx bxs-trash'></i>
                                </button>
                            @endif

                            @if($game->description == null)
                                <button class="rounded-full h-10 w-10 bg-green-600 hover:bg-green-800 text-white mb-2.5" title="Editar descripción" x-on:click="open = true" x-show="!open">
                                    <i class='bx bxs-edit-alt'></i>
                                </button>
                            @endif
                        </div>

                </div>

                {{-- Informacion --}}
                <div class="shadow-lg">
                    <div class="border-l-4 border-blue-600 ml-6 pl-3.5 pr-6 py-2">
                        <div>
                            <header class="mb-1 text-gray-700 font-bold px-3 text-lg">
                                Información del juego
                            </header>

                            <ul class="flex justify-start px-3">
                                <li class="mr-5">
                                    <a href="{{$game->download_site}}" target="_blank"
                                        class="font-semibold text-gray-500 hover:text-blue-700">
                                        <span>
                                            <i class='bx bx-globe'></i>
                                        </span>
                                        Sitio de descarga
                                    </a>
                                </li>
                                <li>
                                    <p class="font-semibold text-gray-500">
                                        <span>
                                            {{--  <i class='bx bxl-unity'></i>  --}}
                                            <i class='bx bxs-component'></i>
                                        </span>
                                        {{$game->game_engine->name}}
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <div>
                <div class="py-2 mb-3 text-gray-700 font-bold flex justify-between items-center px-3 rounded-lg shadow-2xl bg-white">
                    <h3 class="flex items-center text-xl font-bold"><i class='bx bxs-memory-card'></i> <span class="ml-3">Puntos de control</span></h3>

                    <button wire:click="$set('modal_version', true)" class=" text-lg" title="Agregar punto de control">
                        <i class='bx bxs-add-to-queue'></i>
                    </button>
                </div>

                @forelse ($versions as $item)
                    <section class="mb-2 rounded-lg bg-white shadow-lg" @if ($loop->first) x-data="{ open:true }" @else x-data="{ open:false }" @endif>
                        {{--  Informacion del ususario  --}}
                        <header class="font-semibold flex items-center justify-between px-3 py-2 text-white bg-gray-800" :class="open ? 'rounded-t-lg' : 'rounded-lg'">
                            <div class="cursor-pointer flex items-center justify-between w-full" x-on:click="open = !open">
                                <h3> {{$item->version}}
                                    {{--  <span class="text-xs rounded-lg bg-green-600 text-white px-2 py-1"> {{$item->status->status}} </span>   --}}
                                    <span class="text-xs rounded-lg bg-{{$item->status->color}}-600 text-white px-2 py-1">
                                        {{$item->status->status}}
                                    </span>
                                </h3>
                                <time datetime=" {{$item->created_at}} " class="text-sm">
                                    {{ Carbon\Carbon::parse($item->created_at)->isoFormat('D MMMM') }}
                                    <i class='bx bxs-calendar'></i>
                                </time>
                            </div>

                            <div class="relative" x-data="{ option:false }">

                                <span class="text-lg font-bold px-1 rounded-full hover:bg-white hover:text-gray-800" title="Opciones" x-on:click="option = !option">
                                    <i class='bx bx-dots-vertical-rounded'></i>
                                </span>
                                <div class="absolute -bottom-20 right-0 bg-white rounded-lg shadow-2xl text-gray-600 text-sm font-normal" x-show="option">
                                    <ul>
                                        <li>
                                            <button wire:click="Edit({{$item->id}})" class="w-full p-2 flex hover:font-bold hover:text-green-500 hover:shadow-lg">
                                                <span class="mr-2"><i class='bx bxs-edit-alt'></i></span>
                                                Editar
                                            </button>
                                        </li>
                                        <li class="mt-2">
                                            <button onclick="Confirm('la versión','deleteVersion',{{$item->id}})" class="p-2 flex hover:font-bold hover:text-red-500 hover:shadow-lg">
                                                <span class="mr-2"><i class='bx bxs-trash'></i></span>
                                                Eliminar
                                            </button>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </header>

                        {{--  Links de descarga  --}}
                        <footer class="grid px-5 pb-2" x-show="open"
                            x-transition:enter="transition-transform transition-opacity ease-out duration-350"
                            x-transition:enter-start="opacity-0 transform -translate-y-2"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-end="opacity-0 transform -translate-y-3">

                            <p class="mb-2" style="word-wrap: break-word;">{{$item->comment}}</p>

                            <button wire:click="dowloadVersion({{$item->id}})" class="bg-blue-500 w-1/2 mx-auto text-center my-1 py-2 text-white rounded-full px-3 font-semibold hover:bg-blue-700" title="Descarga archivo">
                                <span class="text-xl"><i class='bx bx-cloud-download'></i></span>
                                Descarga archivo
                            </button>
                        </footer>

                    </section>
                @empty
                    <div class="py-2 mb-3 text-gray-700 px-3 rounded-lg shadow-2xl bg-white">
                        <p class="text-center text-sm">No ahí puntos de control guardados, agregue uno nuevo con el botón <span><i class='bx bxs-add-to-queue'></i></span> que se euncuentra en la parte superior.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </section>
</div>

@push('scripts')
    <script>
        document.getElementById("files_version").addEventListener("change", (event) => {
            let path = event.target.files[0].webkitRelativePath;
            let indexEnd = path.indexOf('/');
            let nameFolder;

            if(indexEnd >= 0){
                nameFolder=path.substring(0,indexEnd);
            }else{
                nameFolder="saves";
            }
            window.livewire.emit('setNameFolder',nameFolder);
            //console.log(nameFolder);
          }, false);
    </script>
    <script>
        document.getElementById("files_version_edit").addEventListener("change", (event) => {
            let path = event.target.files[0].webkitRelativePath;
            let indexEnd = path.indexOf('/');
            let nameFolder;

            if(indexEnd >= 0){
                nameFolder=path.substring(0,indexEnd);
            }else{
                nameFolder="saves";
            }
            window.livewire.emit('setNameFolder',nameFolder);
            //console.log(nameFolder);
          }, false);
    </script>
@endpush
