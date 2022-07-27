<aside id="sidebar" class="bg-side-nav border-side-nav hidden w-48 border-r md:block md:w-48 lg:block lg:w-1/6"
    style="margin-top: 52px;">

    <ul class="list-reset flex flex-col">

        @if (Route::has('login'))
            @auth
                <li
                    class="border-light-border {{ Request::is('*gallery') ? ' bg-white' : '' }} h-full w-full border-b py-3 px-2">
                    <a href="{{ route('gallery.index') }}"
                        class="text-nav-item {{ Request::is('*gallery') ? ' font-bold' : '' }} font-sans text-base no-underline hover:text-sky-800">
                        <i class="fas fa-tachometer-alt mx-2"></i>
                        {{ __('Galleries') }}

                    </a>
                </li>
                <li
                    class="border-light-border {{ Request::is('*gallery/create') ? ' bg-white' : '' }} h-full w-full border-b py-3 px-2">
                    <a href="{{ route('gallery.create') }}"
                        class="text-nav-item {{ Request::is('*gallery/create') ? ' font-bold' : '' }} font-sans text-base no-underline hover:text-sky-800">
                        <i class="fas fa-solid fa-images mx-2"></i>
                        {{ __('New gallery') }}
                    </a>
                </li>
                <li
                    class="border-light-border {{ Request::is('*tag') ? ' bg-white' : '' }} h-full w-full border-b py-3 px-2">
                    <a href="{{ route('tag.index') }}"
                        class="text-nav-item {{ Request::is('*tag*') ? ' font-bold' : '' }} font-sans text-base no-underline hover:text-sky-800">
                        <i class="fas fa-tags mx-2"></i>
                        {{ __('Gallery tags') }}</a>
                </li>
                <li
                    class="border-light-border {{ Request::is('*goal') ? ' bg-white' : '' }} h-full w-full border-b py-3 px-2">
                    <a href="{{ route('goal.index') }}"
                        class="text-nav-item {{ Request::is('*goal*') ? ' font-bold' : '' }} font-sans text-base no-underline hover:text-sky-800">
                        <i class="fas fa-crosshairs mx-2"></i>
                        {{ __('Bucket list') }}</a>
                </li>
                <li
                    class="border-light-border {{ Request::is('*user*') ? ' bg-white' : '' }} h-full w-full border-b py-3 px-2">
                    <a href="{{ route('user.show', auth()->id()) }}"
                        class="text-nav-item {{ Request::is('*user*') ? ' font-bold' : '' }} font-sans text-base no-underline hover:text-sky-800">
                        <i class="fas fa-gear mx-2"></i>
                        {{ __('Settings') }}</a>
                </li>
            @else
                <li class="border-light-border h-full w-full border-b py-3 px-2">
                    <a href="{{ url('login') }}"
                        class="text-nav-item font-sans text-base font-normal no-underline hover:text-sky-900">
                        <i class="fa-solid fa-user-check mx-2"></i>
                        {{ __('Login') }}
                    </a>
                </li>

                @if (Route::has('register'))
                    <li class="border-light-border h-full w-full border-b py-3 px-2">
                        <a href="{{ url('register') }}"
                            class="text-nav-item font-sans text-base font-normal no-underline hover:text-sky-800">
                            <i class="fa-solid fa-user-plus mx-2"></i>
                            {{ __('Register') }}
                        </a>
                    </li>
                @endif

            @endauth
        @endif

    </ul>

</aside>
