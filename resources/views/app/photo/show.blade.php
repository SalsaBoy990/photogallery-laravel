@extends('layouts.app')

@section('title')
    <x-breadcrumb :pageTitle="__('Kép szerkesztése 2')" :parentPage="$gallery->name" :entityId="$gallery->id"></x-breadcrumb>
@endsection


@section('content')
    <x-card :size="'3/4'">

        <div class="container mx-auto space-y-2">
            <div class="grid grid-cols-1 gap-6">

                <form action="{{ route('photo.update', $photo->id) }}" method="POST" enctype="multipart/form-data"
                    accept-charset="UTF-8">
                    @method('PUT')
                    @csrf

                    <div class="mb-5 mt-2 block">
                        <h1 class="border-b border-b-gray-200 pb-3 text-left font-serif text-3xl font-bold">
                            {{ __('Edit photo: ') }} {{ $photo->title }}
                        </h1>
                    </div>

                    <div class="mb-5 block">
                        <label for="title" class="form-label text-gray-700">{{ __('Photo title') }}</label>
                        <input type="text" id="title" name="title" value="{{ $photo->title ?? old('title') }}"
                            class="form-control {{ $errors->has('title') ? ' border-rose-400' : '' }} mt-1 input"
                            placeholder="{{ __('Photo title') }}">

                        @if ($errors->has('title'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('title') }}
                            </div>
                        @endif

                    </div>
                    <div class="mb-5 block">
                        <label for="description" class="form-label text-gray-700">{{ __('Photo description') }}</label>
                        <textarea
                            class="form-control {{ $errors->has('description') ? ' border-rose-400' : '' }} m-0 mt-1 textarea"
                            id="description" name="description" rows="5" placeholder="{{ __('Photo description') }}"
                            max="255">{{ $photo->description ?? old('description') }}</textarea>

                        @if ($errors->has('description'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('description') }}
                            </div>
                        @endif

                    </div>

                    <div class="mb-5 block">
                        <label for="location" class="form-label text-gray-700">{{ __('Location') }}</label>
                        <input type="text" id="location" name="location" value="{{ $photo->location ?? old('location') }}"
                            class="form-control {{ $errors->has('location') ? ' border-rose-400' : '' }} mt-1 input"
                            placeholder="{{ __('Photo location') }}">

                        @if ($errors->has('location'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('location') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-5 block">

                        <img class="object-fit block w-full rounded-lg object-cover"
                            src="{{ '/file/' . Auth::id() . '/photo/' . $photo->gallery_id . '/' . $photo->full_image }}"
                            alt="{{ $photo->name }}">

                        <div class="mb-3 w-96">
                            <label for="full_image"
                                class="form-label mb-2 inline-block text-gray-700">{{ __('Change photo') }}
                                <span class="sr-only">{{ __('Change photo') }}</span>
                                <input
                                    class="form-control {{ $errors->has('description') ? ' border-rose-400 ' : '' }} m0 m-0 file-input"
                                    type="file" id="full_image" name="full_image">
                            </label>
                        </div>

                        @if ($errors->has('full_image'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('full_image') }}
                            </div>
                        @endif
                    </div>

                    <div class="block">
                        <div class="flex flex-row gap-x-2">
                            <x-submit-button :linkText="__('Update')"></x-submit-button>
                            <x-link :route="route('gallery.show', $photo->gallery_id)" :linkText="__('Cancel')" :linkType="'secondary'"></x-link>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-card>
@endsection
