<aside id="sidebar" class="bg-side-nav w-full md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">

    <ul class="list-reset flex flex-col">

        @if (Route::has('login'))
        @auth

        <li class=" w-full h-full py-3 px-2 border-b border-light-border">
            <a href="{{ route('gallery.index') }}"
                class="font-sans font-hairline hover:font-normal text-base hover:text-sky-800 text-nav-item no-underline">
                <i class="fas fa-tachometer-alt float-left mx-2 fa-adjust-4"></i>
                Galériák
                <span><i class="fas fa-angle-right float-right fa-adjust-4"></i></span>
            </a>
        </li>
        <li class="w-full h-full py-3 px-2 border-b border-light-border">
            <a href="{{ route('gallery.create') }}"
                class="font-sans font-normal hover:text-sky-800 text-base text-nav-item no-underline">
                <i class="fas fa-solid fa-images mx-2"></i>
                Új Képgaléria</a>
        </li>

        @else

        <li class="w-full h-full py-3 px-2 border-b border-light-border">
            <a href="{{ url('login') }}"
                class="font-sans font-normal hover:text-sky-900 text-base text-nav-item no-underline">
                <i class="fa-solid fa-user-check mx-2"></i>
                Bejelentkezés
            </a>
        </li>


        @if (Route::has('register'))
        <li class="w-full h-full py-3 px-2 border-b border-light-border">
            <a href="{{ url('register') }}"
                class="font-sans font-normal hover:text-sky-800 text-base text-nav-item no-underline">
                <i class="fa-solid fa-user-plus mx-2"></i>
                Regisztráció
            </a>
        </li>
        @endif
        @endauth

        @endif

    </ul>
</aside>