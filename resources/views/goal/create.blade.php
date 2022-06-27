@extends('layouts.main')

@section('title')
    <x-breadcrumb :indexPage="'Bakancslista'" :pageTitle="'Bakancslista bővítése'" :indexPageRoute="'goal.index'">
    </x-breadcrumb>
    <div class="w-full bg-sky-100 p-4">
        <h1 class="mb-3 text-left font-serif text-2xl font-bold">Bakancslista bővítése</h1>
    </div>
@endsection


@section('content')
    <div class="w-half mt-4 mb-10 overflow-hidden bg-white p-4 shadow dark:bg-gray-800 sm:rounded-sm">

        <div class="container mx-auto space-y-2">
            <div class="max-w-md">
                <div class="grid grid-cols-1 gap-6">
                    <form action="{{ route('goal.store') }}" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                        @csrf

                        <div class="mb-5 block">
                            <label for="title" class="form-label text-gray-700">Rövid cím</label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}"
                                class="form-control {{ $errors->has('title') ? ' border-rose-400' : '' }} mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                placeholder="min. 10, max. 255 karakter">

                            @if ($errors->has('title'))
                                <div class="alert mt-2 text-sm text-rose-500">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif

                        </div>
                        <div class="mb-5 block">
                            <label for="description" class="form-label text-gray-700">Rövid leírás</label>
                            <textarea
                                class="form-control {{ $errors->has('description') ? ' border-rose-400' : '' }} m-0 mt-1 block w-full rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-1.5 text-base font-normal text-gray-700 transition ease-in-out focus:border-blue-600 focus:bg-white focus:text-gray-700 focus:outline-none"
                                id="description" name="description" rows="5" placeholder="min. 10, max. 512 karakter" max="512">{{ old('description') }}</textarea>

                            @if ($errors->has('description'))
                                <div class="alert mt-2 text-sm text-rose-500">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif

                        </div>

                        <div class="mb-5 block">
                            <div class="form-check">
                                <input
                                    class="form-check-input float-left mt-1 mr-2 h-4 w-4 cursor-pointer appearance-none rounded-sm border border-gray-300 bg-white bg-contain bg-center bg-no-repeat align-top transition duration-200 checked:border-blue-600 checked:bg-blue-600 focus:outline-none"
                                    type="checkbox" value="1" {{ old('completed') ? ' checked' : '' }} id="completed" name="completed">
                                <label class="form-check-label inline-block text-gray-700" for="completed">
                                    Teljesítve?
                                </label>
                            </div>
                            @if ($errors->has('completed'))
                                <div class="alert mt-2 text-sm text-rose-500">
                                    {{ $errors->first('completed') }}
                                </div>
                            @endif

                        </div>

                        <div class="mb-5 block">
                            <label for="image" class="form-label mb-2 inline-block text-gray-700">Kép feltöltése</label>
                            <input
                                class="form-control m-0 block w-full cursor-pointer rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-1.5 text-base font-normal text-gray-700 transition ease-in-out focus:border-blue-600 focus:bg-white focus:text-gray-700 focus:outline-none"
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

                        <button type="submit"
                            class="inline-block cursor-pointer rounded bg-blue-600 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg">Hozzáadás</button>

                        <a href="{{ route('goal.index') }}" role="button"
                            class="inline-block cursor-pointer rounded bg-blue-600 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg">Mégsem</a>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
