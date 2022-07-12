<nav class="ml-4 mt-1 w-full rounded-md bg-transparent">
    <ol class="list-reset flex">
        <li><a href="{{ route($indexPageRoute) }}"
                class="text-base text-sky-700 hover:text-sky-800">{{ $indexPage }}</a></li>
        @if ($parentPage)
            <li><span class="mx-2 text-base text-gray-500">/</span></li>
            <li><a href="{{ route($parentPageRoute, $entityId) }}"
                    class="text-base text-sky-700 hover:text-sky-800">{{ $parentPage }}</a></li>
        @endif
        <li><span class="mx-2 text-base text-gray-500">/</span></li>
        <li class="text-base text-gray-500"> {{ $pageTitle }}</li>
    </ol>
</nav>
