<x-guest-layout>
    <div
        class="items-top relative flex justify-center bg-gray-100 py-4 dark:bg-gray-900 sm:items-center">
        @if (Route::has('login'))
        <div class="">

            @auth
            <a href="{{ route('gallery.index') }}"
                class="text-base text-gray-700 underline dark:text-gray-500">App</a>
            @else
            <a href="{{ route('login') }}"
                class="text-base text-gray-700 underline dark:text-gray-500">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="ml-4 text-base text-gray-700 underline dark:text-gray-500">Register</a>
            @endif
            @endauth

        </div>
        @endif
    </div>

    <div class="flex justify-center py-4">
        <h1 class="text-2xl">Landing page</h1>
    </div>
</x-guest-layout>