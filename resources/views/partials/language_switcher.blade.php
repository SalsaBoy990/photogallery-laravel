<div class="mx-3 flex justify-center sm:justify-start">

    @foreach ($available_locales as $locale_name => $available_locale)
        @if ($available_locale === $current_locale)
            <span class="ml-1 mr-1 border-2 border-cyan-200 box-border">
                <img class="h-4" src="{{ asset('storage/images/flags/' . $available_locale . '-flag.jpg' ) }}"
                    alt="{{ $locale_name }}">
            </span>
        @else
            <a class="ml-1 mr-1 box-border border-2 border-transparent" title="{{ $locale_name }}" href="{{ route('lang.index', $available_locale) }}">
                <img class="h-4" src="{{ asset('storage/images/flags/' . $available_locale . '-flag.jpg' ) }}" alt="{{ $locale_name }}">
            </a>
        @endif
    @endforeach

</div>
