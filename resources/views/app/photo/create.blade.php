@extends('layouts.app')

@section('title')
    <x-breadcrumb :pageTitle="__('Új kép feltöltése')" :parentPage="$gallery->name" :entityId="$gallery->id"></x-breadcrumb>
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
                        <label for="title" class="form-label text-gray-700">Képcím</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            class="form-control {{ $errors->has('title') ? ' border-rose-400' : '' }} mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50"
                            placeholder="A kép címe">

                        @if ($errors->has('title'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('title') }}
                            </div>
                        @endif

                    </div>
                    <div class="mb-5 block">
                        <label for="description" class="form-label text-gray-700">Képleírás</label>
                        <textarea
                            class="form-control {{ $errors->has('description') ? ' border-rose-400' : '' }} m-0 mt-1 block w-full rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-1.5 text-base font-normal text-gray-700 transition ease-in-out focus:border-sky-600 focus:bg-white focus:text-gray-700 focus:outline-none"
                            id="description" name="description" rows="5" placeholder="A kép rövid leírása" max="255">{{ old('description') }}</textarea>


                        @if ($errors->has('description'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('description') }}
                            </div>
                        @endif

                    </div>

                    <div class="mb-5 block">
                        <label for="location" class="form-label text-gray-700">Helyszín</label>
                        <input type="text" id="location" name="location"
                            class="form-control {{ $errors->has('location') ? ' border-rose-400' : '' }} mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50"
                            placeholder="A kép helyszíne" value="{{ old('location') }}">

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
                        <label for="image" class="form-label mb-2 inline-block text-gray-700">A kép feltöltése</label>
                        <input
                            class="form-control {{ $errors->has('image') ? ' border-rose-400' : '' }} m-0 block w-full cursor-pointer rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-1.5 text-base font-normal text-gray-700 transition ease-in-out focus:border-sky-600 focus:bg-white focus:text-gray-700 focus:outline-none"
                            type="file" id="image" name="image">

                        @if ($errors->has('image'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('image') }}
                            </div>
                        @endif
                    </div>
            </div>

            <div class="block">
                <div class="flex flex-row gap-x-2">
                    <x-submit-button :linkText="__('Add new')"></x-submit-button>
                    <x-link :route="route('gallery.show', $gallery->id)" :linkText="__('Cancel')"></x-link>
                </div>
            </div>
            </form>
        </div>
    </x-card>
@endsection
