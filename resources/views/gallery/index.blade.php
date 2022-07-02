@extends('layouts.main')

@section('title')
<div class="w-full p-4 dark:bg-gray-800">
    @if ($msg = Session::get('success'))

    <div class="alert bg-yellow-100 rounded-lg py-5 px-6 mb-3 text-base text-yellow-700 inline-flex items-center w-full alert-dismissible fade show"
        role="alert">
        {{ $msg }}
        <button type="button"
            class="btn-close box-content w-4 h-4 p-1 ml-auto text-yellow-900 border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-yellow-900 hover:opacity-75 hover:no-underline"
            data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <h1 class="text-left text-4xl font-bold font-serif">{{ __('Gallery list')}}</h1>
</div>
@endsection


@section('content')
<div class="w-full mt-4 p-4 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-sm mb-10">

    <div
        class="container mx-auto space-y-2 grid gap-3 gap-y-6 sm:grid sm:gap-6 sm:gap-y-6 md:space-y-0 md:gap-6 md:gap-y-6 md:grid md:grid-cols-2 lg:space-y-0 lg:gap-6 lg:gap-y-6 lg:grid lg:grid-cols-3">
        @foreach ($galleries as $gallery)

        <div class="w-full rounded">
            <a href="{{ route('gallery.show', $gallery->id) }}">

                @if ($gallery->cover_image === 'placeholder.jpg')
                <img src="{{ asset('storage/images/placeholder.jpg') }}" alt="{{ $gallery->name }}"
                    class="rounded outline outline-gray-600 outline-offset-2 outline-1">
                @else
                <img src="{{ '/file/' . Auth::id() . '/cover/' . $gallery->cover_image }}" alt="{{ $gallery->name }}"
                    class="rounded outline outline-gray-600 outline-offset-2 outline-1">
                @endif

            </a>
            <figcaption class="pt-3 pb-3 font-bold">{{ $gallery->name }}</figcaption>
            <p>{!! $gallery->description !!}</p>
        </div>

        @endforeach

    </div>
</div>
@endsection