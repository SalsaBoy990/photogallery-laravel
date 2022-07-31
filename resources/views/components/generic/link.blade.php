@if ($linkType === 'primary')
    <a href="{{ $route }}" role="button"
        class="inline-block cursor-pointer rounded bg-sky-600 px-6 py-2.5 text-center text-sm font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-sky-700 hover:shadow-lg focus:bg-sky-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-sky-800 active:shadow-lg">
        @if ($iconName)
            <i class="fas fa-{{ $iconName }}"></i>
        @endif
        {{ $linkText }}
    </a>
@elseif ($linkType === 'secondary')
    <a href="{{ $route }}" role="button"
        class="inline-block cursor-pointer rounded bg-gray-300 px-6 py-2.5 text-center text-sm font-medium uppercase leading-tight text-gray-700 shadow-md transition duration-150 ease-in-out hover:text-white hover:bg-gray-500 hover:shadow-lg focus:bg-sky-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-sky-800 active:shadow-lg">
        @if ($iconName)
            <i class="fas fa-{{ $iconName }}"></i>
        @endif
        {{ $linkText }}
    </a>
@elseif ($linkType === 'icon')
    <a href="{{ $route }}" role="button" title="{{ $title ? $title : '' }}"
        class="cursor-pointer rounded border border-sky-600 px-2 py-2 text-sm font-medium uppercase leading-tight text-sky-600 transition duration-150 ease-in-out hover:bg-sky-600 hover:text-white focus:outline-none focus:ring-0">
        @if ($iconName)
            <i class="fas fa-{{ $iconName }}"></i>
        @endif
    </a>
@endif
