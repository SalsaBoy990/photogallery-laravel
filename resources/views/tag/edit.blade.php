@extends('layouts.main')

@section('title')
<x-breadcrumb :indexPage="'Címke szerkesztése'" :pageTitle="$tag->name" :indexPageRoute="'tag.index'"></x-breadcrumb>
<div class="w-full bg-sky-100 p-4">
    <h1 class="mb-3 text-left font-serif text-2xl font-bold">{{ $tag->name . __(' módosítása') }}</h1>
</div>
@endsection


@section('content')
<div class="w-half mt-4 mb-10 overflow-hidden bg-white p-4 shadow dark:bg-gray-800 sm:rounded-sm">

    <div class="container mx-auto space-y-2">
        <div class="max-w-md">
            <div class="grid grid-cols-1 gap-6">
                <form action="{{ route('tag.update', $tag->id) }}" method="POST" enctype="multipart/form-data"
                    accept-charset="UTF-8">
                    @method('PUT')
                    @csrf

                    <div class="mb-5 block">
                        <label for="name" class="form-label text-gray-700">{{ __('Rövid cím') }}</label>
                        <input type="text" id="name" name="name" value="{{ $tag->name ?? old('name') }}"
                            class="form-control {{ $errors->has('name') ? ' border-rose-400' : '' }} mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="min. 3, max. 255 karakter">

                        @if ($errors->has('name'))
                        <div class="alert mt-2 text-sm text-rose-500">
                            {{ $errors->first('name') }}
                        </div>
                        @endif

                    </div>
                    <div class="mb-5 block">
                        <label for="description" class="form-label text-gray-700">{{ __('Rövid leírás') }}</label>
                        <textarea
                            class="form-control {{ $errors->has('description') ? ' border-rose-400' : '' }} m-0 mt-1 block w-full rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-1.5 text-base font-normal text-gray-700 transition ease-in-out focus:border-blue-600 focus:bg-white focus:text-gray-700 focus:outline-none"
                            id="description" name="description" rows="5" placeholder="min. 10, max. 255 karakter"
                            max="512">{{ $tag->description ?? old('description') }}</textarea>

                        @if ($errors->has('description'))
                        <div class="alert mt-2 text-sm text-rose-500">
                            {{ $errors->first('description') }}
                        </div>
                        @endif

                    </div>

                    <div class="block">

                        <div class="flex flex-row gap-x-2">

                            <button type="submit"
                                class="inline-block cursor-pointer rounded bg-blue-600 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg">Módosít</button>

                            <a href="{{ route('tag.index') }}" role="button"
                                class="inline-block cursor-pointer rounded bg-blue-600 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg">Mégsem</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection