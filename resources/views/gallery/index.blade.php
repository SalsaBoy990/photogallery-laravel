@extends('layouts.main')

@section('title')
<div class="w-full p-4 dark:bg-gray-800">
    @if ($msg = Session::get('success'))
    <div class="alert alert-dismissible fade show mb-3 inline-flex w-full items-center rounded-lg bg-yellow-100 py-5 px-6 text-base text-yellow-700"
        role="alert">
        {{ $msg }}
        <button type="button"
            class="btn-close ml-auto box-content h-4 w-4 rounded-none border-none p-1 text-yellow-900 opacity-50 hover:text-yellow-900 hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
            data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <h1 class="text-left font-serif text-4xl font-bold">{{ __('Gallery list') }}</h1>
</div>
@endsection


@section('content')
<div class="mt-4 mb-10 w-full overflow-hidden bg-white p-4 shadow dark:bg-gray-800 sm:rounded-sm">

    <div>
        <small class="text-sm">{{ $galleries->total() }} db galéria</small>
    </div>

    <div
        class="container mx-auto grid gap-3 gap-y-6 space-y-2 sm:grid sm:gap-6 sm:gap-y-6 md:grid md:grid-cols-2 md:gap-6 md:gap-y-6 md:space-y-0 lg:grid lg:grid-cols-3 lg:gap-6 lg:gap-y-6 lg:space-y-0">


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

            <figcaption class="pt-3 pb-1 font-bold text-lg">{{ $gallery->name }}</figcaption>
            <div class="flex space-x-2 justify-left pb-2">
                @foreach ($gallery->tags as $tag)
                <a href="{{ route('tag.show', $tag->id)}}"
                    class="text-xs inline-block py-1 px-2.5 leading-none
                    text-center whitespace-nowrap align-baseline font-bold bg-gray-200 text-gray-700 rounded">{{ $tag->name }}</a>
                @endforeach

            </div>

            <p class="mb-3 text-sm text-gray-500">{{ $gallery->created_at->diffForHumans() }}</p>
            <p>{!! $gallery->description !!}</p>
        </div>
        @endforeach

        <div>
            {{ $galleries->links() }}
        </div>

    </div>
</div>
@endsection