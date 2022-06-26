@extends('layouts.main')

@section('title')
<div class="w-full px-4 pt-0 pb-4 dark:bg-gray-800">

  <x-breadcrumb :pageTitle="$gallery->name"></x-breadcrumb>

  <div class="flex justify-center">
    <div class="rounded-lg shadow-lg bg-white w-full flex flex-row">
      <div>
        <img src="{{ '/file/' . Auth::id() . '/cover/' . $gallery->cover_image }}" alt="{{ $gallery->name }}"
          class="rounded-t-lg h-full w-full">
      </div>
      <div class="p-6">
        <h5 class="text-left text-4xl font-bold font-serif mb-3">{{ $gallery->name }}</h5>
        <p class="text-gray-700 text-base mb-4">
          {{ $gallery->description }}
        </p>
        <button type="button"
          class=" inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Szerkesztés</button>
      </div>
    </div>
  </div>
</div>
@stop


@section('content')
<div class="w-full bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-sm mb-10">

  <div class="mb-3 px-4 pt-4">

    @if ($msg = Session::get('success'))

    <div
      class="alert bg-yellow-100 rounded-lg py-5 px-6 mb-3 text-base text-yellow-700 inline-flex items-center w-full alert-dismissible fade show"
      role="alert">
      {{ $msg }}
      <button type="button"
        class="btn-close box-content w-4 h-4 p-1 ml-auto text-yellow-900 border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-yellow-900 hover:opacity-75 hover:no-underline"
        data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <a href="{{ route('photo.create', $gallery->id)}}" role="button"
      class="m-1 md:m-2 inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
      <i class="fas fa-plus"></i>
      Új kép hozzáadása</a>
  </div>
  <div class="container">

    <div class="px-4 flex flex-wrap">

      @foreach ($photos as $photo)
      <div class="flex flex-wrap w-1/2">
        <div class="w-full p-1 md:p-2">
          <img class="block object-cover object-fit w-full rounded-lg" src="{{ '/file/' . Auth::id() . '/photo/' . $photo->image }}"
            alt="{{ $photo->name }}">
          <figcaption class="pt-3 pb-3 font-bold">{{ $photo->title }}</figcaption>
          <p>{{ $photo->description }}</p>
          <small class="text-sm block mt-3 text-gray-500">
            <i class="fas fa-location-dot"></i>
            {{ $photo->location}}
          </small>
          <a role="button" href="{{ route('photo.show', $photo->id)}}"
            class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Szerkesztés</a>
        </div>
      </div>
      @endforeach

    </div>
  </div>
</div>
@stop