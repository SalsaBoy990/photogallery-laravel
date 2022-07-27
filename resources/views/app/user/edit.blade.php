@extends('layouts.app')

@section('title')
    <x-breadcrumb :indexPage="__('Edit Profile')" :pageTitle="$user->name" :indexPageRoute="'gallery.index'">
    </x-breadcrumb>
@endsection


@section('content')
    <x-card :size="'3/4'">
        <div class="container mx-auto space-y-2">
            <div class="grid grid-cols-1 gap-6">
                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data"
                    accept-charset="UTF-8">
                    @method('PUT')
                    @csrf

                    <div class="mb-5 mt-2 block">
                        <h1 class="border-b border-b-gray-200 pb-3 text-left font-serif text-3xl font-bold">
                            {{ $user->name . __(' change') }}
                        </h1>
                    </div>

                    <div class="mb-5 block">
                        <label for="name" class="form-label text-gray-700">{{ __('Username') }}</label>
                        <input type="text" id="name" name="name"
                            value="{{ $user->name ?? old('name') }}"
                            class="form-control {{ $errors->has('name') ? ' border-rose-400' : '' }} mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50"
                            placeholder="{{ __('min. 3, max. 100 characters') }}">

                        @if ($errors->has('name'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('name') }}
                            </div>
                        @endif

                    </div>
                    <div class="mb-5 block">
                        <label for="description" class="form-label text-gray-700">{{ __('Short biography') }}</label>
                        <textarea
                            class="form-control {{ $errors->has('short_bio') ? ' border-rose-400' : '' }} m-0 mt-1 block w-full rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-1.5 text-base font-normal text-gray-700 transition ease-in-out focus:border-sky-600 focus:bg-white focus:text-gray-700 focus:outline-none"
                            id="short_bio" name="short_bio" rows="5" placeholder="{{ __('min 10, max 255 characters') }}"
                            max="512">{{ $user->short_bio ?? old('short_bio') }}</textarea>

                        @if ($errors->has('short_bio'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('short_bio') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-5 block">
                        @if ($user->avatar_image)
                            <img class="inline-block h-32 w-32 rounded-full"
                                src="{{ '/file/' . $user->id . '/' . $user->avatar_image }}"
                                alt="{{ $user->name }}">
                        @endif

                        <div class="mb-3 w-96">
                            <label for="avatar_image"
                                class="form-label mb-2 inline-block text-gray-700">{{ __('Change avatar image') }}
                                <span class="sr-only">{{ __('Change avatar image') }}</span>
                                <input
                                    class="form-control {{ $errors->has('avatar_image') ? ' border-rose-400 ' : '' }} m0 m-0 block w-full rounded border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-1.5 text-base font-normal text-gray-700 transition ease-in-out file:rounded file:border-gray-300 file:bg-white file:text-base file:text-gray-700 hover:file:cursor-pointer hover:file:bg-gray-900 focus:border-sky-600 focus:bg-white focus:text-gray-700 focus:outline-none focus:file:cursor-pointer"
                                    type="file" id="avatar_image" name="avatar_image">
                            </label>
                        </div>

                        @if ($errors->has('avatar_image'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('avatar_image') }}
                            </div>
                        @endif
                    </div>

                    <div class="block">
                        <div class="flex flex-row gap-x-2">
                            <x-submit-button :linkText="__('Modify')"></x-submit-button>
                            <x-link :route="route('user.show', $user->id)" :linkText="__('Cancel')"></x-link>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-card>
@endsection
