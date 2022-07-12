<div class="relative inline-block">

    @if ($galleryId !== null && $mode == 'attach')
        <a href="{{ route('gallery.tag.attach', ['gallery' => $galleryId, 'tag' => $tagId]) }}"
            class="inline-block whitespace-nowrap rounded bg-gray-200 py-1 pl-2 pr-3 text-center align-baseline text-sm font-bold leading-none text-gray-700">
            <i class="fa-solid fa-plus mr-1"></i>{{ $tagName }}
        </a>
    @else
        <a href="{{ route('tag.show', $tagId) }}"
            class="pl-2 pr-6 inline-block whitespace-nowrap rounded bg-gray-200 py-1 text-center align-baseline text-sm font-bold leading-none text-gray-700">
            {{ $tagName }}
        </a>
        @if ($galleryId !== null)
            <a href="{{ route('gallery.tag.detach', ['gallery' => $galleryId, 'tag' => $tagId]) }}"
                class="absolute top-0.5 right-0.5 inline-block">
                <i class="fa-solid fa-circle-xmark"></i>
            </a>
        @endif


    @endif
</div>
