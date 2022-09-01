<nav class="hidden md:flex sidebar h-4/5 bg-gray-900 open rounded-tl-xl rounded-bl-xl shadow-2xl m-3" style="max-height: calc(100vh - (0.75rem + 0.75rem));
min-height: calc(100vh - (0.75rem + 0.75rem));">
    {{-- Container nav --}}
    <div class="container_nav">
        {{-- Header del nav --}}
        <div class="logo-details">

            <img src="{{ asset('./img/logo.svg') }}" class="icon" alt="Milton">
            <div class="logo_name">Milton</div>
            <i class='bx bx-menu' id="btn"></i>
        </div>

        {{-- Items del menu --}}
        <ul class="nav-list">
            {{--  <li class="item">
                <i class='bx bx-search'></i>
                <input type="text" placeholder="Search...">
                <span class="tooltip">Search</span>
            </li>  --}}
            <li class="item">
                <a href="{{ route('version') }}" class="@routeIs('version')active @endif" >
                    {{--  <i class='bx bxs-archive-out'></i>  --}}
                    <i class='bx bxs-cabinet'></i>
                    <span class="links_name">Versiones</span>
                </a>
                <span class="tooltip">Versiones</span>
            </li>
            <li class="item">
                <a href="#">
                    <i class='bx bx-transfer-alt'></i>
                    <span class="links_name">Traducción</span>
                </a>
                <span class="tooltip">Traducción</span>
            </li>
            <li class="item">
                <a href="#">
                    <i class='bx bx-chat'></i>
                    <span class="links_name">Messages</span>
                </a>
                <span class="tooltip">Messages</span>
            </li>
            <li class="item">
                <a href="#">
                    <i class='bx bx-pie-chart-alt-2'></i>
                    <span class="links_name">Analytics</span>
                </a>
                <span class="tooltip">Analytics</span>
            </li>
            <li class="item">
                <a href="#">
                    <i class='bx bx-folder'></i>
                    <span class="links_name">File Manager</span>
                </a>
                <span class="tooltip">Files</span>
            </li>
        </ul>
    </div>

    {{-- Fotter del nav --}}
    <div class="profile rounded-bl-xl">
        <div class="logo-details">
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="profile_img">
            @else
                <img src="{{ asset('./storage/profile/p.jpg') }}" alt="{{ Auth::user()->name }}" class="profile_img">
            @endif

            <h2 class="logo_name_footer font-semibold">
                {{ Auth::user()->username }}
            </h2>
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <button type="submit">
                    <i class='bx bx-log-out btn_footer' title="Cerrar sesión"></i>
                </button>
            </form>
        </div>
    </div>
</nav>
