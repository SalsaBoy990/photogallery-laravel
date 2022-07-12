@extends('layouts.app')

@section('title')
    <x-breadcrumb :pageTitle="__('Kép szerkesztése 2')" :parentPage="$gallery->name" :entityId="$gallery->id"></x-breadcrumb>
@endsection


@section('content')
    <x-card :size="'3/4'">

        <div class="container mx-auto space-y-2">
            <div class="w-full p-1 md:p-2">
                <img class="object-fit block w-full rounded-lg object-cover"
                    src="{{ '/file/' . Auth::id() . '/photo/' . $photo->image }}" alt="{{ $photo->name }}">
                <figcaption class="pt-3 pb-3 font-bold">{{ $photo->title }}</figcaption>
                <p>{{ $photo->description }}</p>
                <small class="mt-3 block text-sm text-gray-500">
                    <i class="fas fa-location-dot"></i>
                    {{ $photo->location }}
                </small>
            </div>


            <div class="grid grid-cols-1 gap-6">

                <form action="{{ route('photo.update', $photo->id) }}" method="POST" enctype="multipart/form-data"
                    accept-charset="UTF-8">
                    @method('PUT')
                    @csrf

                    <div class="mb-5 mt-2 block">
                        <h1 class="border-b border-b-gray-200 pb-3 text-left font-serif text-3xl font-bold">
                            Kép szerkesztése: {{ $photo->title }}
                        </h1>
                    </div>

                    <div class="mb-5 block">
                        <label for="title" class="form-label text-gray-700">Képcím</label>
                        <input type="text" id="title" name="title" value="{{ $photo->title }}"
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
                        <input type="text" id="description" name="description" value="{{ $photo->description }}"
                            class="form-control {{ $errors->has('description') ? ' border-rose-400' : '' }} mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50"
                            placeholder="A kép rövid leírása">

                        @if ($errors->has('description'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('description') }}
                            </div>
                        @endif

                    </div>

                    <div class="hidden">
                        <input class="hidden" name="gallery_id" type="number" value="{{ $photo->gallery_id }}"
                            id="gallery_id">
                    </div>

                    <div class="mb-5 block">
                        <label for="location" class="form-label text-gray-700">Helyszín</label>
                        <input type="text" id="location" name="location" value="{{ $photo->location }}"
                            class="form-control {{ $errors->has('location') ? ' border-rose-400' : '' }} mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50"
                            placeholder="A kép helyszíne">

                        @if ($errors->has('location'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('location') }}
                            </div>
                        @endif
                    </div>

                    <div class="block">
                        <div class="flex flex-row gap-x-2">
                            <x-submit-button :linkText="__('Update')"></x-submit-button>
                            <x-link :route="route('gallery.show', $photo->gallery_id)" :linkText="__('Cancel')"></x-link>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-card>
@endsection
