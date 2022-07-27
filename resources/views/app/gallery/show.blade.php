@extends('layouts.app')

@section('title')
    <x-breadcrumb :indexPage="__('Galleries')" :pageTitle="$gallery->name"></x-breadcrumb>
    @if ($notification)
        <x-notification :message="$notification['message']" :type="$notification['type']"></x-notification>
    @endif
@endsection
@section('content')
    <div class="w-full rounded-lg bg-white pb-4 shadow-lg">

        <div class="flex flex-col">
            <div class="relative">
                @if ($gallery->cover_image === 'placeholder.jpg')
                    <img src="{{ asset('storage/images/placeholder.jpg') }}" alt="{{ $gallery->name }}"
                        class="h-56 w-full rounded-l-lg object-cover lg:h-80 lg:w-full">
                @else
                    <img src="{{ '/file/' . Auth::id() . '/cover/' . $gallery->cover_image }}" alt="{{ $gallery->name }}"
                        class="h-56 w-full object-cover md:h-48 md:w-full lg:h-80 lg:w-full">
                @endif

                @if (count($photos) > 0)
                    <div id="open-light-gallery-button" class="absolute cursor-pointer p-4 text-center text-white"
                        style="top: 50%; left: 50%; transform: translate(-50%,-50%);background-color: rgba(0,0,0,0.45);">

                        <i class="fa fa-search-plus fa-lg"></i><span
                            class="text-lg font-bold">{{ __('View gallery') }}</span>
                    </div>

                    <div id="lightgallery" class="container">

                        @foreach ($photos as $photo)
                            <a href="{{ '/file/' . Auth::id() . '/photo/' . $photo->gallery_id . '/' . $photo->full_image }}"
                                class="relative" data-title="{{ $photo->title }}">
                                <img class="object-fit w-half hidden rounded-lg object-cover"
                                    src="{{ '/file/' . Auth::id() . '/photo/' . $photo->gallery_id . '/' . $photo->full_image }}"
                                    alt="{{ $photo->title }}">
                            </a>
                        @endforeach

                    </div>
                @endif
            </div>

            <div class="p-6">
                <div class="flex flex-row justify-between">
                    <h5 class="mb-3 text-left font-serif text-4xl font-bold">{{ $gallery->name }}
                    </h5>
                    <div class="flex flex-row gap-x-2">
                        <form class="mt-3" action="{{ route('gallery.destroy', $gallery->id) }}" method="POST">
                            @method('DELETE')
                            @csrf

                            <x-delete-button :title="__('Delete')">
                            </x-delete-button>
                        </form>

                        <a href="{{ route('gallery.edit', $gallery->id) }}" role="button" title="Edit goal"
                            class="mt-3 h-8 cursor-pointer rounded border border-sky-600 px-2 py-2 text-sm font-medium uppercase leading-tight text-sky-600 transition duration-150 ease-in-out hover:bg-sky-600 hover:text-white focus:outline-none focus:ring-0">
                            <i class="fas fa-pencil"></i>{{ __('Edit') }}
                        </a>
                    </div>
                </div>

                <p class="mb-3 text-sm text-gray-500">{{ $gallery->created_at->diffForHumans() }}</p>

                @if (count($gallery->tags))
                    <div class="flex gap-2">
                        @foreach ($gallery->tags as $tag)
                            <x-badge :tagId="$tag->id" :galleryId="$gallery->id" :tagName="$tag->name" :mode="'detach'"></x-badge>
                        @endforeach
                    </div>
                @endif

                @if (count($availableTags))
                    <div class="mt-4 text-sm text-gray-500">{{ __('Add tag: ') }}</div>
                    <div class="mt-1 flex gap-2">
                        @foreach ($availableTags as $availableTag)
                            <x-badge :tagId="$availableTag->id" :galleryId="$gallery->id" :tagName="$availableTag->name" :mode="'attach'">
                            </x-badge>
                        @endforeach
                    </div>
                @endif

                <div class="mb-4 mt-3 text-base text-gray-700">
                    {{-- Mews\Purifier cleans html --}}
                    {!! $gallery->description !!}
                </div>

                <div class="mb-3">
                    <x-link :route="route('photo.create', $gallery->id)" :linkText="__('Add new image')" :iconName="'plus'"></x-link>
                    <a role="button" href="{{ route('gallery.index') }}"
                        class="inline-block rounded bg-sky-600 px-6 py-2.5 text-sm font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-sky-700 hover:shadow-lg focus:bg-sky-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-sky-800 active:shadow-lg">Vissza</a>
                </div>

            </div>

        </div>



        <div class="container px-4">

            <x-gallery-grid>

                @foreach ($photos as $photo)
                    <div class="">
                        <a href="{{ route('photo.show', $photo->id) }}">
                            <img class="object-fit block h-56 w-full rounded-lg object-cover sm:h-72"
                                src="{{ '/file/' . Auth::id() . '/photo/' . $photo->gallery_id . '/' . $photo->full_image }}"
                                alt="{{ $photo->name }}">
                        </a>

                        <figcaption class="pt-3 pb-3 font-bold">{{ $photo->title }}</figcaption>
                        {{-- Mews\Purifier cleans html --}}
                        {!! $photo->description !!}

                        <div class="mt-3 flex flex-row text-sm text-gray-500">
                            <i class="fas fa-location-dot mr-1"></i>
                            {!! $photo->location !!}
                        </div>

                        <div class="mt-3 flex flex-row gap-x-2">

                            <form class="mt-3" action="{{ route('photo.destroy', $photo->id) }}" method="POST">
                                @method('DELETE')
                                @csrf

                                <x-delete-button :title="__('Delete')">
                                </x-delete-button>
                            </form>

                            <a href="{{ route('photo.show', $photo->id) }}" role="button" title="Edit goal"
                                class="mt-3 h-8 cursor-pointer rounded border border-sky-600 px-2 py-2 text-sm font-medium uppercase leading-tight text-sky-600 transition duration-150 ease-in-out hover:bg-sky-600 hover:text-white focus:outline-none focus:ring-0">
                                <i class="fas fa-pencil"></i>{{ __('Edit') }}
                            </a>
                        </div>

                    </div>
                @endforeach

            </x-gallery-grid>

        </div>
    </div>
    </div>
@endsection
