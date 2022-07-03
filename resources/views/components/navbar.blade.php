<!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
<div class="flex justify-between" {{ $attributes }}>
    <div class="mx-3 inline-flex items-center p-1">
        <i class="fas fa-bars cursor-pointer pr-2 text-white transition duration-500" onclick="sidebarToggle()"></i>
        <h1 class="p-2 text-white">Logo</h1>
    </div>
    <div class="w-30 flex flex-row items-center p-1">

        @include('partials/language_switcher')

        <img onclick="profileToggle()" class="inline-block h-8 w-8 cursor-pointer rounded-full" src="{{ $avatar }}"
            alt="{{ $userName }}">
        <a href="#" onclick="profileToggle()" class="hidden p-2 text-white no-underline md:block lg:block">
            {{ $userName }}</a>
        <div id="ProfileDropDown" class="absolute top-0 right-0 mt-12 mr-1 hidden rounded bg-white shadow-md">
            <ul>
                <ul>
                    <li>
                        <a role="button" href="{{ route('user.show', auth()->id()) }}"
                            class="hover:bg-grey-light block w-full cursor-pointer border-b border-gray-200 px-6 py-2 transition duration-500 focus:bg-gray-200 focus:text-gray-600 focus:outline-none focus:ring-0">
                            Profilbeállítások
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="hover:bg-grey-light block w-full cursor-pointer border-b border-gray-200 px-6 py-2 transition duration-500 focus:bg-gray-200 focus:text-gray-600 focus:outline-none focus:ring-0">
                                Kijelentkezés
                            </button>

                        </form>
                    </li>
                </ul>
        </div>
    </div>
</div>
