<!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
<div class="flex justify-between" {{ $attributes }}>
    <div class="p-1 mx-3 inline-flex items-center">
        <i class="fas fa-bars pr-2 text-white transition duration-500 cursor-pointer" onclick="sidebarToggle()"></i>
        <h1 class="text-white p-2">Logo</h1>
    </div>
    <div class="p-1 flex flex-row items-center w-30">

        <img onclick="profileToggle()" class="inline-block h-8 w-8 rounded-full cursor-pointer" src="{{ $avatar }}"
            alt="{{ $userName }}">
        <a href="#" onclick="profileToggle()" class="text-white p-2 no-underline hidden md:block lg:block">
            {{ $userName }}</a>
        <div id="ProfileDropDown" class="rounded hidden shadow-md bg-white absolute top-0 right-0 mt-12 mr-1">
            <ul>
                <!--<li>
                    <a href="#!" class="
                            block
                            px-6
                            py-2
                            border-b border-gray-200
                            w-full
                            hover:bg-grey-light
                            focus:outline-none focus:ring-0 focus:bg-gray-200 focus:text-gray-600
                            transition
                            duration-500
                            cursor-pointer
                          ">
                        Fiókbeállítások
                    </a>
                </li> -->
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="
                            block
                            px-6
                            py-2
                            border-b border-gray-200
                            w-full
                            hover:bg-grey-light
                            focus:outline-none focus:ring-0 focus:bg-gray-200 focus:text-gray-600
                            transition
                            duration-500
                            cursor-pointer
                                            ">
                            Kijelentkezés
                        </button>

                    </form>




                </li>
            </ul>
        </div>
    </div>
</div>