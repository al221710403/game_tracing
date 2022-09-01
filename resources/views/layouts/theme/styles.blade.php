    {{--  Plugins  --}}
    {{--  <link href="{{ asset('plugins/boxicons/boxicons.min.css') }}" rel="stylesheet" type="text/css" />  --}}
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link href="{{ asset('plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <style>
        [x-cloak] { display: none !important; }
    </style>

    @stack('styles')
    @livewireStyles

    {{--  Scripts  --}}
    <script src="{{ mix('js/app.js') }}" defer></script>
