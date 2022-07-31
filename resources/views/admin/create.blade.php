@extends('layouts.app')

@section('title')
<x-breadcrumb :indexPage="__('Administration')" :pageTitle="__('Create user')"
    :indexPageRoute="'admin.index'">
</x-breadcrumb>
@endsection


@section('content')
<x-card :size="'3/4'">
    <div class="container mx-auto space-y-2">
        <div class="grid grid-cols-1 gap-6">
            <form action="{{ route('user.store') }}" method="POST"
                enctype="application/x-www-form-urlencoded" accept-charset="UTF-8">
                @method('POST')
                @csrf

                <div class="mb-5 mt-2 block">
                    <h1
                        class="border-b border-b-gray-200 pb-3 text-left font-serif text-3xl font-bold">
                        {{ __('Create user') }}
                    </h1>
                </div>

                <div class="mb-5 block">
                    <label for="name" class="form-label text-gray-700">{{ __('Username') }}</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="form-control {{ $errors->has('name') ? ' border-rose-400' : '' }} mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50"
                        placeholder="{{ __('min. 3, max. 100 characters') }}">

                    @if ($errors->has('name'))
                    <div class="alert mt-2 text-sm text-rose-500">
                        {{ $errors->first('name') }}
                    </div>
                    @endif

                </div>

                <div class="mb-5 block">
                    <label for="email"
                        class="form-label text-gray-700">{{ __('Email address') }}</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="form-control {{ $errors->has('email') ? ' border-rose-400' : '' }} mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50">

                    @if ($errors->has('email'))
                    <div class="alert mt-2 text-sm text-rose-500">
                        {{ $errors->first('email') }}
                    </div>
                    @endif

                </div>

                <div class="mb-5 block">
                    <label for="password" class="form-label text-gray-700">{{ __('Password') }}</label>
                    <input type="text" id="password" name="password" value="{{ old('password') }}"
                        class="form-control {{ $errors->has('password') ? ' border-rose-400' : '' }} mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50">
                
                    @if ($errors->has('password'))
                    <div class="alert mt-2 text-sm text-rose-500">
                        {{ $errors->first('password') }}
                    </div>
                    @endif
                
                </div>


                <div class="mb-5 block">
                    <label for="role"
                        class="form-label text-gray-700">{{ __('Role') }}</label>
                    <select name="role" id="role"
                        class="form-control {{ $errors->has('role') ? ' border-rose-400' : '' }} mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50">
                        <option value="1">{{ __('Admin') }}</option>
                        <option value="2">{{ __('Customer') }}</option>
                    </select>
                    @if ($errors->has('role'))
                    <div class="alert mt-2 text-sm text-rose-500">
                        {{ $errors->first('role') }}
                    </div>
                    @endif
                </div>

                <div class="mb-5 block">
                    <label for="description"
                        class="form-label text-gray-700">{{ __('Sex') }}</label>
                    <select name="sex" id="sex"
                        class="form-control {{ $errors->has('sex') ? ' border-rose-400' : '' }} mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50">
                        <option value="male">{{ __('Male') }}</option>
                        <option value="female">{{ __('Female') }}</option>
                    </select>
                    @if ($errors->has('sex'))
                    <div class="alert mt-2 text-sm text-rose-500">
                        {{ $errors->first('sex') }}
                    </div>
                    @endif
                </div>



                <div class="block">
                    <div class="flex flex-row gap-x-2">
                        <x-submit-button :linkText="__('Create')"></x-submit-button>
                        <x-link :route="route('admin.index')" :linkText="__('Cancel')" :linkType="'secondary'">
                        </x-link>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-card>
@endsection