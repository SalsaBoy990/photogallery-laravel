@extends('layouts.app')

@section('title')
    <x-breadcrumb :indexPage="__('Bucket list')" :pageTitle="__('Extend bucket list')" :indexPageRoute="'goal.index'">
    </x-breadcrumb>
@endsection

@section('content')
    <x-card :size="'3/4'">

        <div class="container mx-auto space-y-2">
            <div class="grid grid-cols-1 gap-6">
                <form action="{{ route('goal.store') }}" method="POST" enctype="application/x-www-form-urlencoded"
                    accept-charset="UTF-8">
                    @csrf

                    <div class="mb-5 mt-2 block">
                        <h1 class="border-b border-b-gray-200 pb-3 text-left font-serif text-3xl font-bold">
                            {{ __('Extend bucket list') }}
                        </h1>
                    </div>
                    <div class="mb-5 block">
                        <label for="title" class="form-label text-gray-900">{{ __('Short title') }}</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            class="form-control {{ $errors->has('title') ? ' border-rose-400' : '' }} mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50"
                            placeholder="{{ __('min 10, max 255 chars') }}">

                        @if ($errors->has('title'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('title') }}
                            </div>
                        @endif

                    </div>
                    <div class="mb-5 block">
                        <label for="description" class="form-label text-gray-900">{{ __('Short description') }}</label>
                        <textarea
                            class="form-control {{ $errors->has('description') ? ' border-rose-400' : '' }} m-0 mt-1 block w-full rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-1.5 text-base font-normal text-gray-700 transition ease-in-out focus:border-sky-600 focus:bg-white focus:text-gray-700 focus:outline-none"
                            id="description" name="description" rows="5" placeholder="{{ __('min 10, max 255 chars') }}" max="255">{{ old('description') }}</textarea>

                        @if ($errors->has('description'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('description') }}
                            </div>
                        @endif

                    </div>

                    <div class="mb-5 block">
                        <div class="form-check">
                            <input
                                class="form-check-input float-left mt-1 mr-2 checkbox"
                                type="checkbox" value="1" {{ old('completed') ? ' checked' : '' }} id="completed"
                                name="completed">
                            <label class="form-check-label inline-block text-gray-700" for="completed">
                                {{ __('Completed?') }}
                            </label>
                        </div>
                        @if ($errors->has('completed'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('completed') }}
                            </div>
                        @endif

                    </div>

                    <div class="block">
                        <div class="flex flex-row gap-x-2">
                            <x-submit-button :linkText="__('Add new')"></x-submit-button>
                            <x-link :route="route('goal.index')" :linkText="__('Cancel')" :linkType="'secondary'"></x-link>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-card>
@endsection
