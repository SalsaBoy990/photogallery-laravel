@extends('layouts.app')

@section('title')
    <x-breadcrumb :indexPage="'Bakancslista'" :pageTitle="$goal->order . '. ' . $goal->title" :indexPageRoute="'goal.index'"></x-breadcrumb>
@endsection


@section('content')
    <x-card :size="'3/4'">

        <div class="container mx-auto space-y-2">

            <div class="grid grid-cols-1 gap-6">
                <form action="{{ route('goal.update', $goal->id) }}" method="POST" enctype="multipart/form-data"
                    accept-charset="UTF-8">
                    @method('PUT')
                    @csrf

                    <div class="mb-5 mt-2 block">
                        <h1 class="border-b border-b-gray-200 pb-3 text-left font-serif text-3xl font-bold">
                            {{ $goal->title . ' módosítása' }}
                        </h1>
                    </div>

                    <div class="mb-5 block">
                        <label for="title" class="form-label text-gray-700">Rövid cím</label>
                        <input type="text" id="title" name="title" value="{{ $goal->title ?? old('title') }}"
                            class="form-control {{ $errors->has('title') ? ' border-rose-400' : '' }} mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50"
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
                            class="form-control {{ $errors->has('description') ? ' border-rose-400' : '' }} m-0 mt-1 block w-full rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-1.5 text-base font-normal text-gray-700 transition ease-in-out focus:border-sky-600 focus:bg-white focus:text-gray-700 focus:outline-none"
                            id="description" name="description" rows="5" placeholder="min. 10, max. 512 karakter" max="512">{{ $goal->description ?? old('description') }}</textarea>

                        @if ($errors->has('description'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('description') }}
                            </div>
                        @endif

                    </div>

                    <div class="mb-5 block">
                        <div class="form-check">
                            <input
                                class="form-check-input float-left mt-1 mr-2 h-4 w-4 cursor-pointer appearance-none rounded-sm border border-gray-300 bg-white bg-contain bg-center bg-no-repeat align-top transition duration-200 checked:border-sky-600 checked:bg-sky-600 focus:outline-none"
                                type="checkbox" value="1"
                                {{ $goal->completed || old('completed') ? 'checked' : '' }}
                                id="completed" name="completed">
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
                        <label for="image" class="form-label mb-2 inline-block text-gray-700">Kép
                            feltöltése</label>
                        <input
                            class="form-control m-0 block w-full cursor-pointer rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-1.5 text-base font-normal text-gray-700 transition ease-in-out focus:border-sky-600 focus:bg-white focus:text-gray-700 focus:outline-none"
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
                    <x-submit-button :linkText="__('Modify')"></x-submit-button>
                    <x-link :route="route('goal.index')" :linkText="__('Cancel')"></x-link>
                </div>
            </div>
            </form>
        </div>
    </x-card>
@endsection
