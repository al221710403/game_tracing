@push('styles')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<style>
    [x-cloak] { display: none !important; }
</style>
@endpush

<!-- component -->
<div class="flex bg-gray-100 shadow-xl">
    {{--  Spinner  --}}
    <div wire:loading.flex class="absolute bg-black opacity-80 min-h-screen w-full text-white flex justify-center items-center">
        <div class="relative bg-white opacity-100 h-1/3 w-1/3 flex flex-col justify-center items-center rounded">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
            <h2 class="text-black text-2xl mb-5 font-bold">Cargando...</h2>
        </div>
    </div>


    @include('components.modal')

    {{--  Menu lateral  --}}
    <nav class="sidebar bg-gray-900 open m-3 rounded-tl-xl rounded-bl-xl shadow-2xl" style="min-height: calc(100vh - (0.75rem + 0.75rem));">
        {{--  Container nav  --}}
        <div class="container_nav">
            {{--  Header del nav  --}}
            <div class="logo-details">

                <img src="{{ asset('./img/logo.svg') }}" class="icon" alt="Milton">
                <div class="logo_name">Milton</div>
                <i class='bx bx-menu' id="btn" ></i>
            </div>

            {{--  Items del menu  --}}
            <ul class="nav-list">
                <li class="item">
                    <i class='bx bx-search' ></i>
                    <input type="text" placeholder="Search...">
                    <span class="tooltip">Search</span>
                </li>
                <li class="item">
                    <a href="#">
                        <i class='bx bx-grid-alt'></i>
                        <span class="links_name">Dashboard</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                </li>
                <li class="item">
                    <a href="#">
                    <i class='bx bx-user' ></i>
                    <span class="links_name">User</span>
                    </a>
                    <span class="tooltip">User</span>
                </li>
                <li class="item">
                    <a href="#">
                        <i class='bx bx-chat' ></i>
                        <span class="links_name">Messages</span>
                    </a>
                    <span class="tooltip">Messages</span>
                </li>
                <li class="item">
                    <a href="#">
                        <i class='bx bx-pie-chart-alt-2' ></i>
                        <span class="links_name">Analytics</span>
                    </a>
                    <span class="tooltip">Analytics</span>
                </li>
                <li class="item">
                    <a href="#">
                        <i class='bx bx-folder' ></i>
                        <span class="links_name">File Manager</span>
                    </a>
                    <span class="tooltip">Files</span>
                </li>
            </ul>
        </div>

        {{--  Fotter del nav  --}}
        <div class="profile rounded-bl-xl">
            <div class="logo-details">

                <img src="{{ asset('./storage/profile/p.jpg') }}" alt="" class="profile_img">
                <h2 class="logo_name_footer">
                    Cristian Milton Fidel Pascual
                </h2>
                <i class='bx bx-log-out btn_footer' title="Cerrar sesión"></i>
            </div>
        </div>
    </nav>

    {{--  Contenido  --}}
    <main class="grow mt-3 mr-3 flex-col bg-indigo-50" style="min-height: calc(100vh - (0.75rem + 0.75rem));">
        <div class="flex justify-between p-4 bg-white rounded-tr-xl rounded-br-xl shadow-lg">
            <h1 class="text-xl font-bold text-gray-700">Traductor renpy</h1>
        </div>

        {{--  Menu tab  --}}
        <div class="flex justify-between px-4 py-2 bg-white mt-3 rounded-tr-xl rounded-br-xl shadow-lg">
            <ul id="tabs" class="inline-flex w-full">
                <li class="px-4 py-2 -mb-px font-semibold text-gray-800 border-b-2 border-blue-600 rounded-t opacity-70"><a id="default-tab" href="#first">Inicio</a></li>
                <li class="px-4 py-2 font-semibold text-gray-800 rounded-t opacity-50"><a href="#second">Archivos</a></li>
                <li class="px-4 py-2 font-semibold text-gray-800 rounded-t opacity-50"><a href="#tree">modal</a></li>
            </ul>
        </div>

        <!-- Tab Contents -->
        <div id="tab-contents">
          <div id="first">
            {{--  Contenido  --}}
            <div class="flex space-x-4">
                {{-- contenedor izquierdo --}}
                <div class="justify-between w-1/2 rounded-xl mt-4 p-4 bg-white shadow-lg">
                    <h1 class="text-xl font-bold text-gray-800">Texto a traducir</h1>
                    <textarea id="source" rows="8"
                        class="mt-2 block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 bg-indigo-50"
                        placeholder="Texto a traducir..."></textarea>
                </div>

                {{-- contenedor derecho --}}
                <div class="justify-between w-1/2 rounded-xl mt-4 p-4 bg-white shadow-lg">
                    <h1 class="text-xl font-bold text-gray-800">Texto traducido</h1>
                    <div class="mt-2">
                        <input id="name_file" wire:model.lazy="file_name"
                            class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            type="text"
                            placeholder="Nombre del archivo..."/>
                    </div>
                    <textarea disabled id="target" rows="6"
                        class="mt-4 block p-2.5 w-full text-sm text-gray-900 rounded-lg border border-gray-300 bg-gray-200"
                        placeholder="Texto traducido..."></textarea>
                </div>
            </div>

            {{--  Botones de accion  --}}
            <div class="flex justify-end p-4 bg-white mt-3 rounded-xl shadow-lg">
                <button class="py-2 px-3 rounded-lg text-white bg-blue-600" onclick="getTraslate()" type="button">
                    Traducir
                    <span class="ml-1 font-bold">
                        <i class='bx bx-transfer'></i>
                    </span>
                </button>
                <button class="ml-2 py-2 px-3 rounded-lg text-white bg-red-600" onclick="clearTextarea()" type="button">
                    Limpiar
                    <span class="ml-1 font-bold">
                        <i class='bx bx-eraser'></i>
                    </span>
                </button>
                <button class="ml-2 py-2 px-3 rounded-lg text-white bg-green-600" onclick="copyPortapapeles()" type="button">
                    Copiar
                    <span class="ml-1 font-bold">
                        <i class='bx bx-merge'></i>
                    </span>
                </button>
                <button class="ml-2 py-2 px-3 rounded-lg text-white bg-cyan-600" onclick="generateFile()" type="button">
                    Descargar
                    <span class="ml-1 font-bold">
                        <i class='bx bxs-cloud-download'></i>
                    </span>
                </button>
            </div>
          </div>

          <div id="second" class="hidden">
            <div class="p-4 bg-white mt-3 rounded-xl shadow-lg">
                <h3 class="text-xl font-semibold text-gray-700">Traductor de archivos</h3>
                <hr class="mt-2 border-t-2" />
                <form class="pt-3 mb-4 bg-white rounded" wire:submit.prevent="uploadFiles">
                    <div class="mt-2">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="multiple_files">
                            Nombre del archivo
                        </label>
                        <input id="name_file" wire:model.defer="zipName"
                            class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                            type="text"
                            placeholder="Nombre del archivo..." pattern="[A-Za-z0-9-_]+$" required/>
                        {{--  @error('zipName') <span class="text-red-500 mt-2 text-sm">{{ $message}}</span>@enderror  --}}
                    </div>
                    <div class="mb-4 mt-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="multiple_files">
                            Subir archivo(s)
                        </label>
                        <input wire:model="files" class="block w-full text-md text-gray-900 bg-gray-200 rounded-lg border border-gray-300 cursor-pointer focus:outline-none"
                        id="multiple_files" type="file" multiple accept=".txt,.rpy" required>
                        {{--  @error('files') <span class="text-red-500 mt-2 text-sm">{{ $message}}</span>@enderror  --}}
                    </div>

                    <div class="mb-6 text-center">
                        <button class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline" type="submit">
                            Traducir
                        </button>
                    </div>
                </form>
            </div>
          </div>

          <div id="tree">

            <div x-data="{ open: false }" class="border border-red-500">
                <button @click="open = ! open">Toggle</button>

                <div x-show="open" @click.outside="open = false">
                    Contents...
                </div>
            </div>

          </div>
        </div>

    </main>

</div>

@push('scripts')

<script>
    //Validaciones regex
        var rex = /"([^"]*)"/g;
        var rexDiagonal = /\//g;
        //var rex = /"([^"]*)"|'([^']*)'/g;
        //var rex = /(["'])(.*?)\1/g;


        let getTextTraslate,textSource;
        let setTextTraslate = document.getElementById("target");


        function getTraslate(){
            textSource = document.getElementById("source").value;
            if(textSource != ""){
                getTextTraslate = regexValidate(textSource);
                //console.log(getTextTraslate);
                window.livewire.emit('getSource',getTextTraslate);
            }else{
                alert("No hay texto que traducir");
            }

        }

        function regexValidate(text){
            var extractComillas = text.match(rex);
            for (i = 0; i < extractComillas.length; i++) {
                if(rexDiagonal.test(extractComillas[i])){
                    extractComillas[i] = null;
                }
            }

            return extractComillas;
        }

        window.livewire.on('result_traslate', text => {
            //console.table(text);
            var nuevoTexto = textSource;

            for (i = 0; i < text.length; i++) {
                let textClear = text[i] == null ? null : extClear = text[i].match(rex);

                if(textClear === null){
                    textClear = '\"'+text[i]+'\"';
                }
                nuevoTexto = nuevoTexto.replace(getTextTraslate[i], textClear);
            }

            //console.log(nuevoTexto);
            setTextTraslate.value = nuevoTexto;

        });

        function clearTextarea(){
            document.getElementById("target").value="";
            document.getElementById("source").value="";
            document.getElementById("name_file").value="";
        }


        function copyPortapapeles() {
            var content = document.getElementById('target');
            if(content.value != ""){
                content.select();
                document.execCommand('copy');
            }else{
                alert("No hay texto que copiar");
            }

        }

        function generateFile(){
            window.livewire.emit('file',setTextTraslate.value);
        }
</script>


<script>

    window.livewire.on('text_traslate_files', textFiles => {
        console.log(textFiles);
        //for (i = 0; i < textFiles.length; i++) {

        //}

        //getTextTraslate = regexValidate(textSource);

    });
</script>


@endpush
