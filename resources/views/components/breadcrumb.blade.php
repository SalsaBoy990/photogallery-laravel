<nav class="mb-4 mt-1 w-full rounded-md bg-transparent">
    <ol class="list-reset flex">
        <li><a href="{{ route($indexPageRoute) }}"
                class="text-sm text-blue-600 hover:text-blue-700">{{ $indexPage }}</a></li>
        @if ($parentPage)
            <li><span class="mx-2 text-gray-500">/</span></li>
            <li><a href="{{ route($parentPageRoute, $entityId) }}"
                    class="text-sm text-blue-600 hover:text-blue-700">{{ $parentPage }}</a></li>
        @endif
        <li><span class="mx-2 text-gray-500">/</span></li>
        <li class="text-sm text-gray-500"> {{ $pageTitle }}</li>
    </ol>
</nav>
