@extends('layouts.main')

@section('title')

<x-breadcrumb :pageTitle="'Új képgaléria'"></x-breadcrumb>
<div class="w-full p-4 bg-sky-100">
  <h1 class="text-left text-4xl font-bold font-serif mb-3">Új képgaléria készítése</h1>
  <p>Készíts új képgalériát és töltsd fel a képeket!</p>
</div>
@stop


@section('content')
<div class="w-full mt-4 p-4 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-sm mb-10">

  <div class="container mx-auto space-y-2">
    <div class="max-w-md">
      <div class="grid grid-cols-1 gap-6">

        <form action="{!! action('App\Http\Controllers\GalleryController@store') !!}" method="POST"
          enctype="multipart/form-data" accept-charset="UTF-8">
          @csrf

          <div class="block mb-5">
            <label for="name" class="form-label text-gray-700">Név</label>
            <input type="text" id="name" name="name" va class="form-control mt-1 block w-full
        rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200
        focus:ring-opacity-50" placeholder="A galéria neve">

            @if($errors->has('name'))
            <div class="alert mt-2 text-sm text-rose-500">
              {{ $errors->first('name') }}
            </div>
            @endif

          </div>
          <div class="block mb-5">
            <label for="description" class="form-label text-gray-700">Leírás</label>
            <input type="text" id="description" name="description" class="form-control mt-1 block w-full
                    rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200
                    focus:ring-opacity-50" placeholder="A galéria rövid leírása">

            @if($errors->has('description'))
            <div class="alert mt-2 text-sm text-rose-500">
              {{ $errors->first('description') }}
            </div>
            @endif

          </div>

          <div class="block mb-5">
            <label for="cover_image" class="form-label inline-block mb-2 text-gray-700">Borítókép</label>
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
                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" type="file"
              id="cover_image" name="cover_image">

            @if($errors->has('cover_image'))
            <div class="alert mt-2 text-sm text-rose-500">
              {{ $errors->first('cover_image') }}
            </div>
            @endif
          </div>
      </div>

      <div class="block">
        <button type="submit" class="cursor-pointer inline-block px-6 py-2.5 bg-blue-600 text-white
        font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg
        focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition
        duration-150 ease-in-out">Létrehozás</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
@stop