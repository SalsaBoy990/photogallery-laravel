@extends('layouts.main')

@section('title')

<x-breadcrumb :pageTitle="'Új kép feltöltése'" :parentPage="$gallery->name" :entityId="$gallery->id"></x-breadcrumb>
<div class="w-full p-4 bg-sky-100">
  <h1 class="text-left text-2xl font-bold font-serif mb-3">Új kép feltöltése ide: {{ $gallery->name }}</h1>
</div>
@stop


@section('content')
<div class="w-full mt-4 p-4 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-sm mb-10">

  <div class="container mx-auto space-y-2">
    <div class="max-w-md">
      <div class="grid grid-cols-1 gap-6">

        <form action="{!! action('App\Http\Controllers\PhotoController@store') !!}" method="POST"
          enctype="multipart/form-data" accept-charset="UTF-8">
          @csrf

          <div class="block mb-5">
            <label for="title" class="form-label text-gray-700">Képcím</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control mt-1 block w-full
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
            <textarea class="form-control mt-1 block w-full px-3 py-1.5
                text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                rounded transition ease-in-out m-0focus:text-gray-700 focus:bg-white focus:border-blue-600
                focus:outline-none" id="description" name="description" rows="5" placeholder="A kép rövid leírása"
              max="255">{{ old('description') }}</textarea>


            @if ($errors->has('description'))
            <div class="alert mt-2 text-sm text-rose-500">
              {{ $errors->first('description') }}
            </div>
            @endif

          </div>

          <div class="block mb-5">
            <label for="location" class="form-label text-gray-700">Helyszín</label>
            <input type="text" id="location" name="location" class="form-control mt-1 block w-full
               rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200
               focus:ring-opacity-50" placeholder="A kép helyszíne" value="{{ old('location') }}">

            @if ($errors->has('location'))
            <div class="alert mt-2 text-sm text-rose-500">
              {{ $errors->first('location') }}
            </div>
            @endif

          </div>

          <div class="hidden">
            <label for="owner_id">Owner Id</label>
            <input class="hidden" name="owner_id" type="number" value="{{ Auth::id() }}" id="owner_id">
          </div>

          <div class="hidden">
            <label for="gallery_id">Gallery Id</label>
            <input class="hidden" name="gallery_id" type="number" value="{{ $gallery->id }}" id="gallery_id">
          </div>

          <div class="block mb-5">
            <label for="image" class="form-label inline-block mb-2 text-gray-700">A kép feltöltése</label>
            <input class="form-control
                cursor-pointer
                block
                w-full
                px-3
                py-1.5
                text-base
                font-normal
                text-gray-700
                bg-white bg-clip-padding
                border border-solid border-gray-300
                rounded
                transition
                ease-in-out
                m-0
                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="file" id="image"
              name="image">

            @if($errors->has('image'))
            <div class="alert mt-2 text-sm text-rose-500">
              {{ $errors->first('image') }}
            </div>
            @endif
          </div>
      </div>

      <div class="block">
        <button type="submit" class="cursor-pointer inline-block px-6 py-2.5 bg-blue-600 text-white
        font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg
        focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition
        duration-150 ease-in-out">Hozzáadás</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
@stop