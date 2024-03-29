@extends('layouts.app')

@section('title')
    <x-breadcrumb :pageTitle="__('Upload new photo')" :parentPage="$gallery->name" :entityId="$gallery->id"></x-breadcrumb>
@endsection


@section('content')
    <x-card :size="'3/4'">

        <div class="container mx-auto space-y-2">

            <div class="grid grid-cols-1 gap-6">

                <form action="{{ route('photo.store') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                    @csrf

                    <div class="mb-5 mt-2 block">
                        <h1 class="border-b border-b-gray-200 pb-3 text-left font-serif text-3xl font-bold">
                            {{ __('Upload new photo here: ') }}{{ $gallery->name }}</h1>
                    </div>

                    <div class="mb-5 block">
                        <label for="title" class="form-label text-gray-700">{{ __('Image title') }}</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            class="form-control {{ $errors->has('title') ? ' border-rose-400' : '' }} mt-1 input"
                            placeholder="{{ __('Image title') }}">

                        @if ($errors->has('title'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('title') }}
                            </div>
                        @endif

                    </div>
                    <div class="mb-5 block">
                        <label for="description" class="form-label text-gray-700">{{ __('Image description') }}</label>
                        <textarea
                            class="form-control {{ $errors->has('description') ? ' border-rose-400' : '' }} m-0 mt-1 textarea"
                            id="description" name="description" rows="5" placeholder="{{ __('Image description') }}" max="255">{{ old('description') }}</textarea>

                        @if ($errors->has('description'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('description') }}
                            </div>
                        @endif

                    </div>

                    <div class="mb-5 block">
                        <label for="location" class="form-label text-gray-700">{{ __('Location') }}</label>
                        <input type="text" id="location" name="location"
                            class="form-control {{ $errors->has('location') ? ' border-rose-400' : '' }} mt-1 input"
                            placeholder="{{ __('Location') }}" value="{{ old('location') }}">

                        @if ($errors->has('location'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('location') }}
                            </div>
                        @endif

                    </div>

                    <div class="hidden">
                        <input class="hidden" name="gallery_id" type="number" value="{{ $gallery->id }}"
                            id="gallery_id">
                    </div>

                    <div class="mb-5 block">
                        <label for="full_image" class="form-label mb-2 inline-block text-gray-700">{{ __('Upload photo') }}</label>
                        <input
                            class="form-control {{ $errors->has('full_image') ? ' border-rose-400' : '' }} m-0 file-input"
                            type="file" id="full_image" name="full_image">

                        @if ($errors->has('full_image'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('full_image') }}
                            </div>
                        @endif
                    </div>
            </div>

            <div class="block">
                <div class="flex flex-row gap-x-2">
                    <x-submit-button :linkText="__('Add new')"></x-submit-button>
                    <x-link :route="route('gallery.show', $gallery->id)" :linkText="__('Cancel')" :linkType="'secondary'"></x-link>
                </div>
            </div>
            </form>
        </div>
    </x-card>
@endsection
