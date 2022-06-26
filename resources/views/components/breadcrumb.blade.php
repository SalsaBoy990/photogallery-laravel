<nav class="bg-transparent rounded-md w-full mb-4 mt-1">
    <ol class="list-reset flex">
        <li><a href="{{ route($indexPageRoute)}}" class="text-blue-600 hover:text-blue-700 text-sm">Galériák</a></li>
        @if ($parentPage)
        <li><span class="text-gray-500 mx-2">/</span></li>
        <li><a href="{{ route($parentPageRoute, $entityId)}}" class="text-blue-600 hover:text-blue-700 text-sm">{{ $parentPage }}</a></li>

            
        @endif
        <li><span class="text-gray-500 mx-2">/</span></li>
        <li class="text-gray-500 text-sm">{{ $pageTitle }}</li>
    </ol>
</nav>