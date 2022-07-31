@extends('layouts.app')

@section('title')
@php

$pageTitle = __('Create a tag');
$indexPage = __('Tags for galleries');

@endphp
<x-breadcrumb :indexPage="$indexPage" :pageTitle="$pageTitle" :indexPageRoute="'tag.index'">
</x-breadcrumb>
@endsection


@section('content')
<x-card :size="'3/4'">

    <div class="container mx-auto space-y-2">
        <div class="grid grid-cols-1 gap-6">
            <form action="{{ route('tag.store') }}" method="POST" enctype="application/x-www-form-urlencoded"
                accept-charset="UTF-8">
                @csrf

                <div class="mb-5 mt-2 block">
                    <h1
                        class="border-b border-b-gray-200 pb-3 text-left font-serif text-3xl font-bold">
                        {{ __('Create a tag') }}
                    </h1>
                </div>

                <div class="mb-5 block">
                    <label for="name"
                        class="form-label text-gray-700">{{ __('Short title') }}</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="form-control {{ $errors->has('name') ? ' border-rose-400' : '' }} mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50"
                        placeholder="{{ __('min. 10, max. 255 characters') }}">

                    @if ($errors->has('name'))
                    <div class="alert mt-2 text-sm text-rose-500">
                        {{ $errors->first('name') }}
                    </div>
                    @endif

                </div>
                <div class="mb-5 block">
                    <label for="description"
                        class="form-label text-gray-700">{{ __('Short description') }}</label>
                    <textarea
                        class="form-control {{ $errors->has('description') ? ' border-rose-400' : '' }} m-0 mt-1 block w-full rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-1.5 text-base font-normal text-gray-700 transition ease-in-out focus:border-sky-600 focus:bg-white focus:text-gray-700 focus:outline-none"
                        id="description" name="description" rows="5"
                        placeholder="{{ __('min. 10, max. 255 characters') }}"
                        max="255">{{ old('description') }}</textarea>

                    @if ($errors->has('description'))
                    <div class="alert mt-2 text-sm text-rose-500">
                        {{ $errors->first('description') }}
                    </div>
                    @endif

                </div>

                <div class="block">
                    <div class="flex flex-row gap-x-2">
                        <x-submit-button :linkText="__('Add new')"></x-submit-button>
                        <x-link :route="route('tag.index')" :linkText="__('Cancel')" :linkType="'secondary'"></x-link>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-card>
@endsection