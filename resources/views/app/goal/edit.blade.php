@extends('layouts.app')

@section('title')
    <x-breadcrumb :indexPage="__('Bucket list')" :pageTitle="$goal->title" :indexPageRoute="'goal.index'"></x-breadcrumb>
@endsection


@section('content')
    <x-card :size="'3/4'">

        <div class="container mx-auto space-y-2">

            <div class="grid grid-cols-1 gap-6">
                <form action="{{ route('goal.update', $goal->id) }}" method="POST" enctype="application/x-www-form-urlencoded"
                    accept-charset="UTF-8">
                    @method('PUT')
                    @csrf

                    <div class="mb-5 mt-2 block">
                        <h1 class="border-b border-b-gray-200 pb-3 text-left font-serif text-3xl font-bold">
                            {{ __('Update: ') . $goal->title }}
                        </h1>
                    </div>

                    <div class="mb-5 block">
                        <label for="title" class="form-label text-gray-700">{{ __('Short title') }}</label>
                        <input type="text" id="title" name="title" value="{{ $goal->title ?? old('title') }}"
                            class="form-control {{ $errors->has('title') ? ' border-rose-400' : '' }} mt-1 input"
                            placeholder="__('min 10, max 255 chars')">

                        @if ($errors->has('title'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('title') }}
                            </div>
                        @endif

                    </div>
                    <div class="mb-5 block">
                        <label for="description" class="form-label text-gray-700">{{ __('Short description') }}</label>
                        <textarea
                            class="form-control {{ $errors->has('description') ? ' border-rose-400' : '' }} m-0 mt-1 textarea"
                            id="description" name="description" rows="5" placeholder="__('min 10, max 255 chars')">{{ $goal->description ?? old('description') }}</textarea>

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
                                type="checkbox" value="1"
                                {{ $goal->completed || old('completed') ? 'checked' : '' }}
                                id="completed" name="completed">
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
                            <x-submit-button :linkText="__('Modify')"></x-submit-button>
                            <x-link :route="route('goal.index')" :linkText="__('Cancel')" :linkType="'secondary'"></x-link>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-card>
@endsection
