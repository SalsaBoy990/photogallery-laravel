<x-guest-layout>
    <div class="w-screen">
        <div class="px-4 lg:py-12">
            <div class="flex justify-center lg:gap-4">
                <div class="flex flex-col items-center justify-center md:py-24 lg:py-32">
                    <h1 class="mb-3 font-serif text-9xl font-bold text-sky-600">404</h1>
                    <p class="mb-2 text-center text-2xl font-bold text-gray-800 md:text-3xl">
                        <span class="text-rose-500">{{ __('Oops!') }}</span>{{ __(' Page not found') }}
                    </p>
                    <p class="mb-8 text-center text-gray-500 md:text-lg">
                        {{ __('The page you’re looking for doesn’t exist.') }}
                    </p>

                    @auth
                        <a href="{{ route('gallery.index') }}"
                            class="bg-sky-600 px-6 py-2 text-sm font-semibold text-sky-50 hover:bg-sky-700">{{ __('Go home') }}</a>
                    @endauth

                    @guest
                        <a href="/"
                            class="bg-sky-600 px-6 py-2 text-sm font-semibold text-sky-50 hover:bg-sky-700">{{ __('Go home') }}</a>
                    @endguest

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
