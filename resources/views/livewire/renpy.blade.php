@push('styles')

    <style>
        .spinner {
            margin: 50px auto;
            width: 40px;
            height: 40px;
            position: relative;
            text-align: center;

            -webkit-animation: sk-rotate 2.0s infinite linear;
            animation: sk-rotate 2.0s infinite linear;
        }

        .dot1,
        .dot2 {
            width: 60%;
            height: 60%;
            display: inline-block;
            position: absolute;
            top: 0;
            background-color: black;
            border-radius: 100%;

            -webkit-animation: sk-bounce 2.0s infinite ease-in-out;
            animation: sk-bounce 2.0s infinite ease-in-out;
        }

        .dot2 {
            top: auto;
            bottom: 0;
            -webkit-animation-delay: -1.0s;
            animation-delay: -1.0s;
        }

        @-webkit-keyframes sk-rotate {
            100% {
                -webkit-transform: rotate(360deg)
            }
        }

        @keyframes sk-rotate {
            100% {
                transform: rotate(360deg);
                -webkit-transform: rotate(360deg)
            }
        }

        @-webkit-keyframes sk-bounce {

            0%,
            100% {
                -webkit-transform: scale(0.0)
            }

            50% {
                -webkit-transform: scale(1.0)
            }
        }

        @keyframes sk-bounce {

            0%,
            100% {
                transform: scale(0.0);
                -webkit-transform: scale(0.0);
            }

            50% {
                transform: scale(1.0);
                -webkit-transform: scale(1.0);
            }
        }
    </style>

    <style>
        /* Google Font Link */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  box-sizing: border-box;
  font-family: "Poppins" , sans-serif;
}
            /* ============================================ */
            /* FIN DEL GRID AREA */
            /* ============================================ */


            .sidebar {
                position: fixed;
                left: 0;
                top: 0;
                height: 100%;
                width: 78px;
                background: #11101D;
                padding: 6px 14px;
                z-index: 99;
                transition: all 0.5s ease;
            }

            .sidebar.open {
                width: 250px;
            }

            .sidebar .logo-details {
                height: 60px;
                display: flex;
                align-items: center;
                position: relative;
            }

            .sidebar .logo-details .icon {
                opacity: 0;
                transition: all 0.5s ease;
            }

            .sidebar .logo-details .logo_name {
                color: #fff;
                font-size: 20px;
                font-weight: 600;
                opacity: 0;
                transition: all 0.5s ease;
            }

            .sidebar.open .logo-details .icon,
            .sidebar.open .logo-details .logo_name {
                opacity: 1;
            }

            .sidebar .logo-details #btn {
                position: absolute;
                top: 50%;
                right: 0;
                transform: translateY(-50%);
                font-size: 22px;
                transition: all 0.4s ease;
                font-size: 23px;
                text-align: center;
                cursor: pointer;
                transition: all 0.5s ease;
            }

            .sidebar.open .logo-details #btn {
                text-align: right;
            }

            .sidebar i {
                color: #fff;
                height: 60px;
                min-width: 50px;
                font-size: 28px;
                text-align: center;
                line-height: 60px;
            }

            .sidebar .nav-list {
                margin-top: 20px;
                height: 100%;
            }

            .sidebar li {
                position: relative;
                margin: 8px 0;
                list-style: none;
            }

            .sidebar li .tooltip {
                position: absolute;
                top: -20px;
                left: calc(100% + 15px);
                z-index: 3;
                background: #fff;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
                padding: 6px 12px;
                border-radius: 4px;
                font-size: 15px;
                font-weight: 400;
                opacity: 0;
                white-space: nowrap;
                pointer-events: none;
                transition: 0s;
            }

            .sidebar li:hover .tooltip {
                opacity: 1;
                pointer-events: auto;
                transition: all 0.4s ease;
                top: 50%;
                transform: translateY(-50%);
            }

            .sidebar.open li .tooltip {
                display: none;
            }

            .sidebar input {
                font-size: 15px;
                color: #FFF;
                font-weight: 400;
                outline: none;
                height: 50px;
                width: 100%;
                width: 50px;
                border: none;
                border-radius: 12px;
                transition: all 0.5s ease;
                background: #1d1b31;
            }

            .sidebar.open input {
                padding: 0 20px 0 50px;
                width: 100%;
            }

            .sidebar .bx-search {
                position: absolute;
                top: 50%;
                left: 0;
                transform: translateY(-50%);
                font-size: 22px;
                background: #1d1b31;
                color: #FFF;
            }

            .sidebar.open .bx-search:hover {
                background: #1d1b31;
                color: #FFF;
            }

            .sidebar .bx-search:hover {
                background: #FFF;
                color: #11101d;
            }

            .sidebar li a {
                display: flex;
                height: 100%;
                width: 100%;
                border-radius: 12px;
                align-items: center;
                text-decoration: none;
                transition: all 0.4s ease;
                background: #11101D;
            }

            .sidebar li a:hover {
                background: #FFF;
            }

            .sidebar li a .links_name {
                color: #fff;
                font-size: 15px;
                font-weight: 400;
                white-space: nowrap;
                opacity: 0;
                pointer-events: none;
                transition: 0.4s;
            }

            .sidebar.open li a .links_name {
                opacity: 1;
                pointer-events: auto;
            }

            .sidebar li a:hover .links_name,
            .sidebar li a:hover i {
                transition: all 0.5s ease;
                color: #11101D;
            }

            .sidebar li i {
                height: 50px;
                line-height: 50px;
                font-size: 18px;
                border-radius: 12px;
            }

            .sidebar li.profile {
                position: fixed;
                height: 60px;
                width: 78px;
                left: 0;
                bottom: -8px;
                padding: 10px 14px;
                background: #1d1b31;
                transition: all 0.5s ease;
                overflow: hidden;
            }

            .sidebar.open li.profile {
                width: 250px;
            }

            .sidebar li .profile-details {
                display: flex;
                align-items: center;
                flex-wrap: nowrap;
            }

            .sidebar li img {
                height: 45px;
                width: 45px;
                object-fit: cover;
                border-radius: 6px;
                margin-right: 10px;
            }

            .sidebar li.profile .name,
            .sidebar li.profile .job {
                font-size: 15px;
                font-weight: 400;
                color: #fff;
                white-space: nowrap;
            }

            .sidebar li.profile .job {
                font-size: 12px;
            }

            .sidebar .profile #log_out {
                position: absolute;
                top: 50%;
                right: 0;
                transform: translateY(-50%);
                background: #1d1b31;
                width: 100%;
                height: 60px;
                line-height: 60px;
                border-radius: 0px;
                transition: all 0.5s ease;
            }

            .sidebar.open .profile #log_out {
                width: 50px;
                background: none;
            }

            .home-section {
                position: relative;
                background: #E4E9F7;
                min-height: 100vh;
                top: 0;
                left: 78px;
                width: calc(100% - 78px);
                transition: all 0.5s ease;
                z-index: 2;
            }

            .sidebar.open~.home-section {
                left: 250px;
                width: calc(100% - 250px);
            }

            .home-section .text {
                display: inline-block;
                color: #11101d;
                font-size: 25px;
                font-weight: 500;
                margin: 18px
            }

            @media (max-width: 420px) {
                .sidebar li .tooltip {
                    display: none;
                }
            }
        </style>
@endpush

<!-- component -->
<div class="flex bg-gray-100 rounded-xl shadow-xl relative">
    {{--  Spinner  --}}
    <div wire:loading.flex class="absolute bg-black opacity-80 min-h-screen w-full text-white flex justify-center items-center">
        <div class="bg-white opacity-100 h-1/3 w-1/3 flex flex-col justify-center items-center rounded">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
            <h2 class="text-black text-2xl mb-5 font-bold">Cargando...</h2>
        </div>
    </div>
    {{-- menu --}}
    {{--  <aside class="flex px-16 space-y-16 overflow-hidden m-3 pb-4 flex-col items-center justify-center rounded-tl-xl rounded-bl-xl bg-gray-900 shadow-lg"
        style="min-height: calc(100vh - (0.75rem + 0.75rem));">
        <div class="flex items-center justify-center p-4 shadow-lg">
            <div>
                <img src="https://i.imgur.com/c6U7KtF.png" alt="" class="h-8 mb-2" />
            </div>
            <h1 class="text-white font-bold mr-2 cursor-pointer">XFIT KIDS</h1>
        </div>
        <ul>
            <li
                class="flex space-x-2 mt-4 px-6 py-4 text-white hover:bg-white hover:text-blue-800 font-bold hover:rounded-br-3xl transition duration-100 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg><a href="">Dashboard</a>
            </li>
            <li
                class="flex space-x-2 mt-4 px-6 py-4 text-white hover:bg-white hover:text-blue-800 font-bold hover:rounded-br-3xl transition duration-100 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg><a href="">Settings</a>
            </li>
        </ul>
    </aside>  --}}

    <aside class="sidebar">
        <div class="logo-details">
          <i class='bx bxl-c-plus-plus icon'></i>
            <div class="logo_name">CodingLab</div>
            <i class='bx bx-menu' id="btn" ></i>
        </div>

        <ul class="nav-list">
          <li>
              <i class='bx bx-search' ></i>
             <input type="text" placeholder="Search...">
             <span class="tooltip">Search</span>
          </li>
          <li>
            <a href="#">
              <i class='bx bx-grid-alt'></i>
              <span class="links_name">Dashboard</span>
            </a>
             <span class="tooltip">Dashboard</span>
          </li>
          <li>
           <a href="#">
             <i class='bx bx-user' ></i>
             <span class="links_name">User</span>
           </a>
           <span class="tooltip">User</span>
         </li>
         <li>
           <a href="#">
             <i class='bx bx-chat' ></i>
             <span class="links_name">Messages</span>
           </a>
           <span class="tooltip">Messages</span>
         </li>
         <li>
           <a href="#">
             <i class='bx bx-pie-chart-alt-2' ></i>
             <span class="links_name">Analytics</span>
           </a>
           <span class="tooltip">Analytics</span>
         </li>
         <li>
           <a href="#">
             <i class='bx bx-folder' ></i>
             <span class="links_name">File Manager</span>
           </a>
           <span class="tooltip">Files</span>
         </li>
         <li>
           <a href="#">
             <i class='bx bx-cart-alt' ></i>
             <span class="links_name">Order</span>
           </a>
           <span class="tooltip">Order</span>
         </li>
         <li>
           <a href="#">
             <i class='bx bx-heart' ></i>
             <span class="links_name">Saved</span>
           </a>
           <span class="tooltip">Saved</span>
         </li>
         <li>
           <a href="#">
             <i class='bx bx-cog' ></i>
             <span class="links_name">Setting</span>
           </a>
           <span class="tooltip">Setting</span>
         </li>
         <li class="profile">
             <div class="profile-details">
               <!--<img src="profile.jpg" alt="profileImg">-->
               <div class="name_job">
                 <div class="name">Prem Shahi</div>
                 <div class="job">Web designer</div>
               </div>
             </div>
             <i class='bx bx-log-out' id="log_out" ></i>
         </li>
        </ul>
    </aside>

    {{-- Contenido --}}
    <main class="home-section flex-col bg-indigo-50 pl-4 pr-6">
    {{--  <main class="home-section flex-col bg-indigo-50 w-full ml-4 pr-6">  --}}
        <div class="flex justify-between p-4 bg-white mt-3 rounded-xl shadow-lg">
            <h1 class="text-xl font-bold text-gray-700">Traductor renpy</h1>
        </div>

        {{--  Menu tab  --}}
        <div class="flex justify-between px-4 py-2 bg-white mt-3 rounded-xl shadow-lg">
            <ul id="tabs" class="inline-flex w-full">
                <li class="px-4 py-2 -mb-px font-semibold text-gray-800 border-b-2 border-blue-600 rounded-t opacity-70"><a id="default-tab" href="#first">Inicio</a></li>
                <li class="px-4 py-2 font-semibold text-gray-800 rounded-t opacity-50"><a href="#second">Archivos</a></li>
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
                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-bold text-gray-700" for="multiple_files">
                            Subir archivo(s)
                        </label>
                        <input wire:model="files" class="block w-full text-md text-gray-900 bg-gray-200 rounded-lg border border-gray-300 cursor-pointer focus:outline-none" id="multiple_files" type="file" multiple>
                    </div>

                    <div class="mb-6 text-center">
                        <button class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-full hover:bg-blue-700 focus:outline-none focus:shadow-outline" type="submit">
                            Traducir
                        </button>
                    </div>
                </form>
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

    {{--  Script para tab  --}}
    <script>
        let tabsContainer = document.querySelector("#tabs");

        let tabTogglers = tabsContainer.querySelectorAll("a");
        console.log(tabTogglers);

        tabTogglers.forEach(function(toggler) {
            toggler.addEventListener("click", function(e) {
                e.preventDefault();

                let tabName = this.getAttribute("href");

                let tabContents = document.querySelector("#tab-contents");

                for (let i = 0; i < tabContents.children.length; i++) {

                    tabTogglers[i].parentElement.classList.remove("border-blue-600", "border-b",  "-mb-px", "opacity-100");  tabContents.children[i].classList.remove("hidden");
                    if ("#" + tabContents.children[i].id === tabName) {
                        continue;
                    }
                    tabContents.children[i].classList.add("hidden");
                }
                e.target.parentElement.classList.add("border-blue-600", "border-b-4", "-mb-px", "opacity-100");
            });
        });

        document.getElementById("default-tab").click();

    </script>



    <script>
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");
        let searchBtn = document.querySelector(".bx-search");

        closeBtn.addEventListener("click", ()=>{
          sidebar.classList.toggle("open");
          menuBtnChange();//calling the function(optional)
        });

        searchBtn.addEventListener("click", ()=>{ // Sidebar open when you click on the search iocn
          sidebar.classList.toggle("open");
          menuBtnChange(); //calling the function(optional)
        });

        // following are the code to change sidebar button(optional)
        function menuBtnChange() {
         if(sidebar.classList.contains("open")){
           closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
         }else {
           closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
         }
        }
        </script>
@endpush
