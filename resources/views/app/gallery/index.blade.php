@extends('layouts.app')

@section('title')
    @if ($notification = Session::get('notification'))
        <x-notification :message="$notification['message']" :type="$notification['type']"></x-notification>
    @endif
@endsection


@section('content')
    <x-card>

        <h1 class="mb-6 border-b border-b-gray-200 text-left font-serif text-4xl font-bold">
            {{ __('Galleries') }}<small class="ml-2 text-lg">({{ $galleries->total() }})</small>
        </h1>

        <x-gallery-grid>
            @foreach ($galleries as $gallery)
                <div class="w-full rounded">
                    @auth
                        <a href="{{ route('gallery.show', $gallery->id) }}">

                            @if ($gallery->thumbnail_image === 'placeholder.jpg')
                                <img src="{{ asset('storage/images/placeholder.jpg') }}" alt="{{ $gallery->name }}"
                                    class="rounded outline outline-1 outline-offset-2 outline-gray-600">
                            @else
                                <img src="{{ '/file/' . Auth::id() . '/cover/' . $gallery->thumbnail_image }}"
                                    alt="{{ $gallery->name }}"
                                    class="rounded outline outline-1 outline-offset-2 outline-gray-600">
                            @endif

                        </a>
                    @endauth

                    <figcaption class="pt-3 pb-1 text-lg font-bold">
                        <a href="{{ route('gallery.show', $gallery->id) }}">
                            {{ $gallery->name }}
                        </a>
                    </figcaption>
                    <div class="justify-left flex space-x-2 pb-2">
                        @foreach ($gallery->tags as $tag)
                            <a href="{{ route('tag.show', $tag->id) }}"
                                class="inline-block whitespace-nowrap rounded bg-gray-200 py-1 px-2.5 text-center align-baseline text-xs font-bold leading-none text-gray-700">{{ $tag->name }}</a>
                        @endforeach

                    </div>

                    <p class="mb-3 text-sm text-gray-500">{{ $gallery->created_at->diffForHumans() }}</p>
                </div>
            @endforeach
        </x-gallery-grid>

        <div class="pt-12">
            {{ $galleries->links() }}
        </div>
    </x-card>
@endsection
