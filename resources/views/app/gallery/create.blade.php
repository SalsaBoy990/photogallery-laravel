@extends('layouts.app')

@section('title')
    <x-breadcrumb :indexPage="__('Galleries')" :pageTitle="__('New gallery')"></x-breadcrumb>
@endsection

@section('content')
    <x-card :size="'3/4'">

        <div class="container mx-auto space-y-2">
            <div class="grid grid-cols-1 gap-6">

                <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8"
                    autocomplete="off">
                    @csrf

                    <div class="mb-5 mt-2 block">
                        <h1 class="border-b border-b-gray-200 pb-3 text-left font-serif text-3xl font-bold">
                            {{ __('Create a new photo gallery') }}
                        </h1>
                    </div>

                    <div class="mb-5 block">
                        <label for="name" class="form-label text-gray-700">{{ __('Name') }}</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="form-control {{ $errors->has('name') ? ' border-rose-400' : '' }} input mt-1"
                            placeholder="{{ __('Gallery name') }}">

                        @if ($errors->has('name'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('name') }}
                            </div>
                        @endif

                    </div>
                    <div class="mb-5 block">
                        <label for="description" class="form-label text-gray-700">{{ __('Description') }}</label>

                        <textarea class="form-control {{ $errors->has('description') ? ' border-rose-400' : '' }} textarea m-0 mt-1"
                            id="description" name="description" rows="5" placeholder="{{ __('Short description') }}" max="255">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('description') }}
                            </div>
                        @endif

                    </div>

                    <div class="mb-5 block">
                        <div class="mb-3 w-96">
                            <label for="cover_image"
                                class="form-label mb-2 inline-block text-gray-700">{{ __('Cover image') }}
                                <span class="sr-only">{{ __('Choose photo') }}</span>
                                <input
                                    class="form-control {{ $errors->has('cover_image') ? ' border-rose-400 ' : '' }} m0 file-input m-0"
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
                            <x-submit-button :linkText="__('Create')"></x-submit-button>
                            <x-link :route="route('gallery.index')" :linkText="__('Back')" :linkType="'secondary'"></x-link>
                        </div>
                    </div>
                </form>
            </div>
    </x-card>
@endsection
