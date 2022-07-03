<div class="flex justify-center sm:justify-start mx-2">
    @foreach($available_locales as $locale_name => $available_locale)
    @if($available_locale === $current_locale)
    <span class="ml-2 mr-2 text-gray-200">{{ $locale_name }}</span>
    @else
    <a class="underline ml-2 mr-2 text-gray-400" href="{{ route('lang.index', $available_locale)}}">
        <span>{{ $locale_name }}</span>
    </a>
    @endif
    @endforeach
</div>