{{--  Etiquetas de cantidad de juegos y usuarios  --}}
<article class="mb-2 grid grid-cols-2 gap-2">

    {{--  Etiqueta de Usuarios  --}}
    <article class="widget w-full p-4 rounded-lg border-l-4 "
        style="background-color: #242526; border-color: #6d6b83;">
        <div class="flex items-center">
            <div class="icon w-12 p-2 text-white rounded-full mr-3" style="background-color: #6d6b83">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <div class="flex flex-col justify-center">
                <div class="text-lg font-bold text-gray-300 text-center"> {{$userCount}} </div>
                <div class="text-sm text-gray-300">
                    <h4>Usuarios</h4>
                </div>
            </div>
        </div>
    </article>

    {{--  Etiqueta de Juegos  --}}
    <article class="widget w-full p-4 rounded-lg border-l-4 "
        style="background-color: #242526; border-color: #6d6b83;">
        <div class="flex items-center">
            <div class="icon w-12 p-2 text-white rounded-full mr-3" style="background-color: #6d6b83">
                {{--  <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>  --}}
                <i class="fas fa-gamepad"></i>
            </div>
            <div class="flex flex-col justify-center">
                <div class="text-lg font-bold text-gray-300 text-center"> {{$gameCount}} </div>
                <div class="text-sm text-gray-300">
                    <h4>Juegos</h4>
                </div>
            </div>
        </div>
    </article>

</article>

{{--  Seccion del buscador  --}}
{{--  <article class="mb-2 rounded-lg text-gray-300 p-4" style="background-color: #242526;">
    <header class="text-base"><h3>Búscar juego</h3></header>
    <div class="relative w-full bg-gray-300 rounded-lg mt-1 py-1 text-gray-500">
        <button class="w-full text-left px-3 py-1 text-sm ml-5">
            Buscar juego <code class="text-xs italic font-semibold border border-gray-500 rounded-lg ml-2 py-1 px-1.5"> Ctrl + K</code>
        </button>
        <svg class="text-gray-500 w-4 h-4 absolute left-2.5 top-2.5" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </div>
</article>  --}}

{{--  Sección de generos  --}}
<div class="rounded-lg p-3 mb-2" style="background-color: #242526;">
    <section class="mb-2">
        <header>
            <h3 class="text-xl text-gray-300">Géneros</h3>
        </header>
        <div>
            <ul class="flex flex-wrap items-center">
                @foreach ($genders as $gender)
                    <li class="bg-{{$gender->color}}-500 hover:bg-{{$gender->color}}-800 text-white italic px-2 py-1 m-1 rounded-lg">
                        <a href="{{ route('game.showGender', $gender) }}"> <i class="fas fa-tag"></i> {{$gender->name}} </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
</div>

{{--  Seccion de apóyo a la página  --}}
<article class="mb-2 rounded-lg text-gray-300 p-4" style="background-color: #242526;">
    <header>
        <h3 class="text-xl">Apóya la página</h3>
    </header>
    <div>
        <p class="text-sm text-justify">¿Te gústo la página? Puedes apóyarnos para que la página siga en pie y siga
            ofreciendo contenido.</p>
        <p class="text-sm text-justify font-semibold mt-1">Solo da click en algúno de los enlaces.</p>
    </div>
    <div class="flex items-center justify-center mt-2">
        <a href="#" class="text-xs flex items-center mr-4">
                <span class="w-6 h-6 rounded-full mr-2 bg-gray-900"></span>
            <h3 class="mr-2">Paypal</h3>
        </a>

        <a href="#" class="text-xs flex items-center">
                <span class="w-6 h-6 rounded-full mr-2 bg-red-800"></span>
            <h3 class="mr-2">Patreón</h3>
        </a>
    </div>
</article>
