@extends('layouts.guest')

@section('content')
<div class="w-screen">
  <div class="px-4 lg:py-12">
    <div class="lg:gap-4 flex justify-center">
      <div class="flex flex-col items-center justify-center md:py-24 lg:py-32">
        <h1 class="font-bold text-sky-600 text-9xl font-serif mb-3">404</h1>
        <p class="mb-2 text-2xl font-bold text-center text-gray-800 md:text-3xl">
          <span class="text-rose-500">{{ __('Oops!')}}</span>{{ __(' Page not found')}} 
        </p>
        <p class="mb-8 text-center text-gray-500 md:text-lg">
          {{ __('The page you’re looking for doesn’t exist.') }}
        </p>
        <a href="{{ route('gallery.index')}}" class="px-6 py-2 text-sm font-semibold text-sky-50 bg-sky-600 hover:bg-sky-700">{{ __('Go home')}}</a>
      </div>
    </div>
  </div>
</div>
@stop