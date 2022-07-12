@extends('layouts.app')

@section('title')
    <div class="w-full p-4 dark:bg-gray-800">
        @if ($msg = Session::get('success'))
            <x-success-alert :message="$msg"></x-success-alert>
        @endif
        <h1 class="text-left font-serif text-4xl font-bold">{{ __('Settings') }}</h1>
    </div>
@endsection


@section('content')
    <div
        class="grid gap-3 gap-y-6 space-y-2 sm:grid sm:gap-6 sm:gap-y-6 md:grid md:grid-cols-2 md:gap-6 md:gap-y-6 md:space-y-0 lg:grid lg:grid-cols-2 lg:gap-6 lg:gap-y-6 lg:space-y-0">

        <div class="mb-10 w-full bg-white p-4 shadow dark:bg-gray-800 sm:rounded-sm">
            <div class="container mx-auto">
                <h2 class="text-2xl font-bold">{{ Auth::user()->name }}</h2>
                <small class="text-base text-gray-500">{{ Auth::user()->email }}</small>
                <p class="py-3 text-gray-700">{{ Auth::user()->short_bio }}</p>
            </div>
        </div>

        <div style="width: 100%" class="mt-4 mb-10 w-full bg-white p-4 shadow dark:bg-gray-800 sm:rounded-sm">
            <div class="container mx-auto">
                <h2 class="mb-3 text-xl font-bold">{{ __('Change password') }}</h2>

                <form action="{{ route('user.change.password') }}" method="POST" enctype="application/x-www-form-urlencoded"
                    accept-charset="UTF-8">
                    @method('PUT')
                    @csrf

                    <div class="mb-5 block">
                        <label for="old_password" class="form-label text-gray-700">{{ __('Old password') }}</label>
                        <input type="password" id="old_password" name="old_password" value="{{ old('old_password') }}"
                            class="form-control {{ $errors->has('old_password') ? ' border-rose-400' : '' }} mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50"
                            placeholder="">

                        @if ($errors->has('old_password'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('old_password') }}
                            </div>
                        @endif

                    </div>

                    <div class="mb-5 block">
                        <label for="new_password" class="form-label text-gray-700">{{ __('New password') }}</label>
                        <input type="password" id="new_password" name="new_password" value="{{ old('new_password') }}"
                            class="form-control {{ $errors->has('new_password') ? ' border-rose-400' : '' }} mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50"
                            placeholder="">

                        @if ($errors->has('new_password'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('new_password') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-5 block">
                        <label for="new_password_confirmation"
                            class="form-label text-gray-700">{{ __('New password again') }}</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" value=""
                            class="form-control {{ $errors->has('new_password_confirmation') ? ' border-rose-400' : '' }} mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50"
                            placeholder="">

                        @if ($errors->has('new_password_confirmation'))
                            <div class="alert mt-2 text-sm text-rose-500">
                                {{ $errors->first('new_password_confirmation') }}
                            </div>
                        @endif
                    </div>

                    <div class="block">
                        <div class="flex flex-row gap-x-2">
                            <x-submit-button :linkText="__('Modify')"></x-submit-button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection
