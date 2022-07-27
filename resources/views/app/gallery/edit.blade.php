@extends('layouts.app')

@section('content')
    <x-breadcrumb :pageTitle="$gallery->name"></x-breadcrumb>
    <div class="w-full px-4 pt-3 pb-4">

        @if (isset($notification))
            <x-notification :message="$notification['message']" :type="$notification['type']"></x-notification>
        @endif

        <x-card :size="'3/4'">

            <div class="container mx-auto space-y-2">
                <div class="grid grid-cols-1 gap-6">

                    <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data"
                        accept-charset="UTF-8" autocomplete="off">
                        @csrf
                        @method('PUT')

                        <div class="mb-5 mt-2 block">
                            <h1 class="border-b border-b-gray-200 pb-3 text-left font-serif text-3xl font-bold">
                                {{ __('Update photo gallery') }}
                            </h1>
                        </div>

                        <div class="mb-5 block">
                            <label for="name" class="form-label text-gray-700">{{ __('Name') }}</label>
                            <input type="text" id="name" name="name" value="{{ $gallery->name ?? old('name') }}"
                                class="form-control {{ $errors->has('name') ? ' border-rose-400' : '' }} mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50"
                                placeholder="{{ __('Gallery name') }}">

                            @if ($errors->has('name'))
                                <div class="alert mt-2 text-sm text-rose-500">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif

                        </div>
                        <div class="mb-5 block">
                            <label for="description" class="form-label text-gray-700">{{ __('Description') }}</label>
                            <input type="text" id="description" name="description"
                                value="{{ $gallery->description ?? old('description') }}"
                                class="form-control {{ $errors->has('description') ? ' border-rose-400' : '' }} mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50"
                                placeholder="{{ __('Short description') }}">

                            @if ($errors->has('description'))
                                <div class="alert mt-2 text-sm text-rose-500">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif

                        </div>

                        <div class="mb-5 block">

                            @if ($gallery->cover_image === 'placeholder.jpg')
                                <img src="{{ asset('storage/images/placeholder.jpg') }}" alt="{{ $gallery->name }}"
                                    class="h-56 w-full rounded-l-lg object-cover">
                            @else
                                <img src="{{ '/file/' . Auth::id() . '/cover/' . $gallery->thumbnail_image }}"
                                    alt="{{ $gallery->name }}"
                                    class="h-56 w-full object-cover md:h-48 md:w-full lg:h-80 lg:w-full">
                            @endif
                            <div class="mb-3 w-96">
                                <label for="cover_image"
                                    class="form-label mb-2 inline-block text-gray-700">{{ __('Change photo') }}
                                    <span class="sr-only">{{ __('Change photo') }}</span>
                                    <input
                                        class="form-control {{ $errors->has('description') ? ' border-rose-400 ' : '' }} m0 m-0 block w-full rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-1.5 text-base font-normal text-gray-700 transition ease-in-out file:rounded file:border-gray-300 file:bg-white file:text-base file:text-gray-700 hover:file:cursor-pointer hover:file:bg-gray-900 focus:border-sky-600 focus:bg-white focus:text-gray-700 focus:outline-none focus:file:cursor-pointer"
                                        type="file" id="cover_image" name="cover_image">
                                </label>
                            </div>

                            @if ($errors->has('cover_image'))
                                <div class="alert mt-2 text-sm text-rose-500">
                                    {{ $errors->first('cover_image') }}
                                </div>
                            @endif
                        </div>


                        <div class="block">
                            <div class="flex flex-row gap-x-2">
                                <x-submit-button :linkText="__('Update')"></x-submit-button>
                                <x-link :route="route('gallery.show', $gallery->id)" :linkText="__('Back')"></x-link>
                            </div>
                        </div>
                    </form>
                </div>
        </x-card>

    </div>
@endsection
