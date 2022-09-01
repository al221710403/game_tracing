<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('img/logo-white-background.svg')}}" />

        {{--  Styles  --}}
        @include('layouts.theme.styles')

    </head>
    <body>
        <div class="font-quick overflow-hidden	flex bg-gray-100 shadow-xl min-h-screen max-h-screen">

            {{--  Menu de navegacion  --}}
            @include('layouts.theme.nav')

            {{--  Contenido  --}}
            <main class="overflow-y-auto py-3 pr-3 grow" style="max-height: 100vh;
            min-height:100vh;">
                {{ $slot }}
            </main>
        </div>


        @include('layouts.theme.scripts')
    </body>
</html>
