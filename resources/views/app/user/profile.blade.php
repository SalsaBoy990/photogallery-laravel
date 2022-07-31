@extends('layouts.app')

@section('title')
    <div class="w-full pt-0 pr-4 pl-4 pb-4">
        @if ($notification = Session::get('notification'))
            <x-notification :message="$notification['message']" :type="$notification['type']"></x-notification>
        @endif
        <h1 class="pt-2 text-left font-serif text-4xl font-bold">{{ __('Settings') }}</h1>
    </div>
@endsection


@section('content')
    <div
        class="grid gap-3 gap-y-6 space-y-2 sm:grid sm:gap-6 sm:gap-y-6 md:grid md:grid-cols-2 md:gap-6 md:gap-y-6 md:space-y-0 lg:grid lg:grid-cols-2 lg:gap-6 lg:gap-y-6 lg:space-y-0">

        <div class="mb-10 w-full bg-white p-4 shadow sm:rounded-sm">
            <div class="container mx-auto">

                @if ($user->avatar_image)
                    <img src="{{ '/file/' . $user->id . '/' . $user->avatar_image }}" alt="{{ $user->name }}"
                        class="h-16 w-16 rounded-full">
                @elseif ($user->sex === 'male')
                    <img class="mb-2 h-16 w-16 rounded-full" src="{{ asset('storage/images/avatar-male.png') }}"
                        alt="{{ $user->name }}">
                @else
                    <img class="mb-2 h-16 w-16 rounded-full" src="{{ asset('storage/images/avatar-female.png') }}"
                        alt="{{ $user->name }}">
                @endif

                <h2 class="text-2xl font-bold">{{ $user->name }}</h2>
                <div class="text-base text-gray-500">{{ $user->email }}</div>
                <div class="text-base text-gray-500">{{ $user->sex === 'male' ? __('Male') : __('Female') }}</div>
                <div class="text-base text-gray-500">{{ $user->role === 'customer' ? __('Customer') : __('Admin') }}</div>
                <p class="py-3 text-gray-700">{{ $user->short_bio }}</p>

                <x-link :route="route('user.edit', $user->id)" :linkText="__('Edit')"></x-link>
            </div>
        </div>

        <div style="width: 100%" class="mt-4 mb-10 w-full bg-white p-4 shadow dark:bg-gray-800 sm:rounded-sm">
            <div class="container mx-auto">
                <h2 class="mb-3 text-xl font-bold">{{ __('Change password') }}</h2>

                <form action="{{ route('user.change.password') }}" method="POST"
                    enctype="application/x-www-form-urlencoded" accept-charset="UTF-8">
                    @method('PUT')
                    @csrf

                    <div class="mb-5 block">
                        <label for="old_password" class="form-label text-gray-700">{{ __('Old password') }}</label>
                        <input type="password" id="old_password" name="old_password" value="{{ old('old_password') }}"
                            class="form-control {{ $errors->has('old_password') ? ' border-rose-400' : '' }} input mt-1"
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
                            class="form-control {{ $errors->has('new_password') ? ' border-rose-400' : '' }} input mt-1"
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
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                            value=""
                            class="form-control {{ $errors->has('new_password_confirmation') ? ' border-rose-400' : '' }} input mt-1"
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
