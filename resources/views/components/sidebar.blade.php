<aside id="sidebar" class="bg-side-nav border-side-nav hidden w-full border-r md:block md:w-1/6 lg:block lg:w-1/6">

    <ul class="list-reset flex flex-col">

        @if (Route::has('login'))
        @auth

        <li class="border-light-border h-full w-full border-b py-3 px-2">
            <a href="{{ route('gallery.index') }}"
                class="text-nav-item {{ Request::is('*gallery') ? ' font-bold' : '' }} font-sans text-base no-underline hover:text-sky-800">
                <i class="fas fa-tachometer-alt fa-adjust-4 float-left mx-2"></i>
                Galériák
                <span><i class="fas fa-angle-right fa-adjust-4 float-right"></i></span>
            </a>
        </li>
        <li class="border-light-border h-full w-full border-b py-3 px-2">
            <a href="{{ route('gallery.create') }}"
                class="font-sanshover:text-sky-800 text-nav-item {{ Request::is('*gallery/create') ? ' font-bold' : '' }} text-base no-underline">
                <i class="fas fa-solid fa-images mx-2"></i>
                Új Képgaléria</a>
        </li>
        <li class="border-light-border h-full w-full border-b py-3 px-2">
            <a href="{{ route('goal.index') }}"
                class="text-nav-item {{ Request::is('*goal*') ? ' font-bold' : '' }} font-sans text-base no-underline hover:text-sky-800">
                <i class="fas fa-crosshairs mx-2"></i>
                Bakancslista</a>
        </li>
        @else
        <li class="border-light-border h-full w-full border-b py-3 px-2">
            <a href="{{ url('login') }}"
                class="text-nav-item font-sans text-base font-normal no-underline hover:text-sky-900">
                <i class="fa-solid fa-user-check mx-2"></i>
                Bejelentkezés
            </a>
        </li>


        @if (Route::has('register'))
        <li class="border-light-border h-full w-full border-b py-3 px-2">
            <a href="{{ url('register') }}"
                class="text-nav-item font-sans text-base font-normal no-underline hover:text-sky-800">
                <i class="fa-solid fa-user-plus mx-2"></i>
                Regisztráció
            </a>
        </li>
        @endif
        @endauth

        @endif

    </ul>
    @include('partials/language_switcher')
</aside>