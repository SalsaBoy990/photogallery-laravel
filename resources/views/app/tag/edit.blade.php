@extends('layouts.app')

@section('title')
    <x-breadcrumb :indexPage="__('Edit tag')" :pageTitle="$tag->name" :indexPageRoute="'tag.index'">
    </x-breadcrumb>
@endsection


@section('content')
    <x-card :size="'3/4'">
        <div class="container mx-auto space-y-2">
            <div class="grid grid-cols-1 gap-6">
                <form action="{{ route('tag.update', $tag->id) }}" method="POST" enctype="application/x-www-form-urlencoded"
                    accept-charset="UTF-8">
                    @method('PUT')
                    @csrf

                    <div class="mb-5 mt-2 block">
                        <h1 class="border-b border-b-gray-200 pb-3 text-left font-serif text-3xl font-bold">
                            {{ __("Update: ") . $tag->name }}
                        </h1>
                    </div>

                    <div class="mb-5 block">
                        <label for="name" class="form-label text-gray-700">{{ __('Short title') }}</label>
                        <input type="text" id="name" name="name" value="{{ $tag->name ?? old('name') }}"
                            class="form-control {{ $errors->has('name') ? ' border-rose-400' : '' }} mt-1 input"
                            placeholder="{{ __('min. 3, max. 255 characters') }}">

                        @if ($errors->has('name'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('name') }}
                            </div>
                        @endif

                    </div>
                    <div class="mb-5 block">
                        <label for="description" class="form-label text-gray-700">{{ __('Short description') }}</label>
                        <textarea
                            class="form-control {{ $errors->has('description') ? ' border-rose-400' : '' }} m-0 mt-1 textarea"
                            id="description" name="description" rows="5" placeholder="{{ __('min. 10, max. 255 characters') }}"
                            max="255">{{ $tag->description ?? old('description') }}</textarea>

                        @if ($errors->has('description'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('description') }}
                            </div>
                        @endif

                    </div>

                    <div class="block">
                        <div class="flex flex-row gap-x-2">
                            <x-submit-button :linkText="__('Modify')"></x-submit-button>
                            <x-link :route="route('tag.index')" :linkText="__('Cancel')" :linkType="'secondary'"></x-link>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-card>
@endsection
