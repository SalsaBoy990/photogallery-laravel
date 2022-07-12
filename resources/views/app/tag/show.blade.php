@extends('layouts.app')

@section('title')
    <x-breadcrumb :indexPage="__('Tag details')" :pageTitle="$tag->name" :indexPageRoute="'tag.index'">
    </x-breadcrumb>
@endsection


@section('content')
    <x-card :size="'full'">

        <div class="flex w-full flex-row">
            <div class="p-6">
                <h2 class="mb-3 text-left font-serif text-3xl font-bold">{{ $tag->name }}</h2>
                <div class="mb-4 text-base text-gray-700">
                    {{-- Mews\Purifier cleans html --}}
                    {!! $tag->description !!}
                </div>

                <x-submit-button :linkText="__('Modify')"></x-submit-button>
                <x-link :route="URL::previous() == URL::current() ? route('tag.index') : URL::previous()" :linkText="__('Cancel')"></x-link>
            </div>
        </div>
    </x-card>

    <x-card :size="'full'">
        <h2 class="mb-6 border-b border-b-gray-200 text-left font-serif text-2xl font-bold">
            {{ __('Galleries belonging to ') }}"{{ $tag->name }}"<small
                class="ml-2 font-sans text-base font-normal">({{ $galleries->total() }}
                db)</small>
        </h2>

        <x-gallery-grid>

            @foreach ($galleries as $gallery)
                <div class="w-full rounded">
                    @auth
                        <a href="{{ route('gallery.show', $gallery->id) }}">

                            @if ($gallery->cover_image === 'placeholder.jpg')
                                <img src="{{ asset('storage/images/placeholder.jpg') }}" alt="{{ $gallery->name }}"
                                    class="rounded outline outline-1 outline-offset-2 outline-gray-600">
                            @else
                                <img src="{{ '/file/' . Auth::id() . '/cover/' . $gallery->cover_image }}"
                                    alt="{{ $gallery->name }}"
                                    class="rounded outline outline-1 outline-offset-2 outline-gray-600">
                            @endif

                        </a>
                    @endauth

                    <figcaption class="pt-3 pb-1 text-lg font-bold">{{ $gallery->name }}</figcaption>
                    <p class="mb-3 text-sm text-gray-500">{{ $gallery->created_at->diffForHumans() }}</p>
                    <p>{!! $gallery->description !!}</p>
                </div>
            @endforeach
        </x-gallery-grid>
        <div class="pt-12">
            {{ $galleries->links() }}
        </div>
    </x-card>
@endsection
