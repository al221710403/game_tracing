<!DOCTYPE html>
{{--  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">  --}}
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ mix('css/vendor.css') }}">

        {{--  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">  --}}
        {{--  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>  --}}

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="{{ mix('js/vendor.js') }}" defer></script>

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
        @stack('css')

        @livewireStyles

    </head>
     <body class="relative scroll-pr bg-primary-darck">

        {{--  Menu de navegación  --}}
        @livewire('navegation')

        {{--  Contenido  --}}
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 ">
            @if (isset($header))
                {{ $header }}
            @endif

            {{--  Contenedor del cuerpo  --}}
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 py-4 mb-3">

                {{--  Contenido e la pagina  --}}
                <main class="w-full bg-cover bg-center md:col-span-3">
                    {{ $slot }}
                </main>

                {{--  Aside  --}}
                <aside class="w-full bg-cover bg-center hidden lg:block">
                    @include('layouts.components.aside')

                    @if (isset($aside))
                        {{ $aside }}
                    @endif
                </aside>
            </div>
        </div>

        {{--  Footer  --}}
        @include('layouts.components.footer')

        <!-- Swiper JS -->
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

        @livewireScripts

        @stack('js')

        {{--  Scripts  --}}
        @if (isset($script))
            {{ $script }}
        @endif
    </body>
</html>
