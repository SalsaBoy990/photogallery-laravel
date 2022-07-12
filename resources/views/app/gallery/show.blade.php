@extends('layouts.app')

@section('title')
    <x-breadcrumb :pageTitle="$gallery->name"></x-breadcrumb>
    <div class="w-full px-4 pt-3 pb-4 dark:bg-gray-800">

        @if ($success)
            <x-success-alert :message="$success"></x-success-alert>
        @endif

        <div class="w-full rounded-lg bg-white shadow-lg">

            <div class="md:flex">
                <div class="md:shrink-1 lg:shrink-1">
                    @if ($gallery->cover_image === 'placeholder.jpg')
                        <img src="{{ asset('storage/images/placeholder.jpg') }}" alt="{{ $gallery->name }}"
                            class="h-56 w-full rounded-l-lg object-cover lg:h-80 lg:w-full">
                    @else
                        <img src="{{ '/file/' . Auth::id() . '/cover/' . $gallery->cover_image }}"
                            alt="{{ $gallery->name }}" class="h-56 w-full object-cover md:h-48 md:w-full lg:h-80 lg:w-full">
                    @endif
                </div>


                <div class="p-6">
                    <h5 class="mb-3 text-left font-serif text-4xl font-bold">{{ $gallery->name }}</h5>

                    @if (count($gallery->tags))
                        <div class="flex gap-2">
                            @foreach ($gallery->tags as $tag)
                                <x-badge :tagId="$tag->id" :galleryId="$gallery->id" :tagName="$tag->name" :mode="'detach'"></x-badge>
                            @endforeach
                        </div>
                    @endif

                    @if (count($availableTags))
                        <div class="mt-4 flex gap-2">
                            <span class="text-sm text-gray-500">Címke hozzáadása: </span>
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
                    <button type="button"
                        class="inline-block rounded bg-sky-600 px-6 py-2.5 text-sm font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-sky-700 hover:shadow-lg focus:bg-sky-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-sky-800 active:shadow-lg">Szerkesztés</button>

                    <a role="button"
                        href="{{ URL::previous() == URL::current() ? route('gallery.index') : URL::previous() }}"
                        class="inline-block rounded bg-sky-600 px-6 py-2.5 text-sm font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-sky-700 hover:shadow-lg focus:bg-sky-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-sky-800 active:shadow-lg">Vissza</a>
                </div>

            </div>
        </div>

    </div>
@endsection


@section('content')
    <x-card>

        <div class="mb-3 px-4 pt-4">

            @if ($msg = Session::get('success') && !$success)
                <x-success-alert>{{ $msg }}</x-success-alert>
            @endif

            @auth
                <div class="md:m-2">
                    <x-link :route="route('photo.create', $gallery->id)" :linkText="__('Add new Image')" :iconName="'plus'"></x-link>
                </div>
            @endauth

        </div>
        <div class="container">

            <div class="flex flex-wrap px-4">

                @foreach ($photos as $photo)
                    <div class="flex w-1/2 flex-wrap">
                        <div class="w-full p-1 md:p-2">
                            <img class="object-fit block w-full rounded-lg object-cover"
                                src="{{ '/file/' . Auth::id() . '/photo/' . $photo->image }}" alt="{{ $photo->name }}">
                            <figcaption class="pt-3 pb-3 font-bold">{{ $photo->title }}</figcaption>
                            {{-- Mews\Purifier cleans html, <p> --}}
                            {!! $photo->description !!}
                            <small class="mt-3 block text-sm text-gray-500">
                                <i class="fas fa-location-dot"></i>
                                {{ $photo->location }}
                            </small>

                            @auth
                                <x-link :route="route('photo.show', $photo->id)" :linkText="__('Edit image')" :iconName="'plus'"></x-link>
                            @endauth

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </x-card>
@endsection
