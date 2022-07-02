@extends('layouts.main')

@section('title')

<x-breadcrumb :pageTitle="'Kép szerkesztése'" :parentPage="$gallery->name" :entityId="$gallery->id"></x-breadcrumb>
<div class="w-full p-4 bg-sky-100">
  <h1 class="text-left text-2xl font-bold font-serif mb-3">Kép szerkesztése: {{ $photo->title }}</h1>
</div>
@stop


@section('content')
<div class="w-full mt-4 p-4 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-sm mb-10">

  <div class="container mx-auto space-y-2">
    <div class="w-full p-1 md:p-2">
      <img class="block object-cover object-fit w-full rounded-lg" src="{{ '/file/' . Auth::id() . '/photo/' . $photo->image }}"
        alt="{{ $photo->name }}">
      <figcaption class="pt-3 pb-3 font-bold">{{ $photo->title }}</figcaption>
      <p>{{ $photo->description }}</p>
      <small class="text-sm block mt-3 text-gray-500">
        <i class="fas fa-location-dot"></i>
        {{ $photo->location }}
      </small>
    </div>


    <div class="max-w-md">
      <div class="grid grid-cols-1 gap-6">

        <form action="{!! action('App\Http\Controllers\PhotoController@update', $photo->id) !!}" method="POST"
          enctype="multipart/form-data" accept-charset="UTF-8">
          @method('PUT')
          @csrf

          <div class="block mb-5">
            <label for="title" class="form-label text-gray-700">Képcím</label>
            <input type="text" id="title" name="title" value="{{ $photo->title }}" class="form-control mt-1 block w-full
        rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200
        focus:ring-opacity-50" placeholder="A kép címe">

            @if ($errors->has('title'))
            <div class="alert mt-2 text-sm text-rose-500">
              {{ $errors->first('title') }}
            </div>
            @endif

          </div>
          <div class="block mb-5">
            <label for="description" class="form-label text-gray-700">Képleírás</label>
            <input type="text" id="description" name="description" value="{{ $photo->description }}" class="form-control mt-1 block w-full
                    rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200
                    focus:ring-opacity-50" placeholder="A kép rövid leírása">

            @if ($errors->has('description'))
            <div class="alert mt-2 text-sm text-rose-500">
              {{ $errors->first('description') }}
            </div>
            @endif

          </div>

          <div class="hidden">
            <label for="user_id">Owner Id</label>
            <input class="hidden" name="user_id" type="number" value="{{ $photo->user_id }}" id="user_id">
          </div>

          <div class="hidden">
            <label for="gallery_id">Gallery Id</label>
            <input class="hidden" name="gallery_id" type="number" value="{{ $photo->gallery_id }}" id="gallery_id">
          </div>

          <div class="block mb-5">
            <label for="location" class="form-label text-gray-700">Helyszín</label>
            <input type="text" id="location" name="location" value="{{ $photo->location }}" class="form-control mt-1 block w-full
                                        rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200
                                        focus:ring-opacity-50" placeholder="A kép helyszíne">

            @if ($errors->has('location'))
            <div class="alert mt-2 text-sm text-rose-500">
              {{ $errors->first('location') }}
            </div>
            @endif
          </div>

          <div class="block">
            <button type="submit" class="cursor-pointer inline-block px-6 py-2.5 bg-blue-600 text-white
        font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg
        focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition
        duration-150 ease-in-out">Frissít</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@stop