@extends('layouts.main')

@section('title')
    <div class="w-full p-4 dark:bg-gray-800">
        @if ($msg = Session::get('success'))
            <div class="alert alert-dismissible fade show mb-3 inline-flex w-full items-center rounded-lg bg-yellow-100 py-5 px-6 text-base text-yellow-700"
                role="alert">
                {{ $msg }}
                <button type="button"
                    class="btn-close ml-auto box-content h-4 w-4 rounded-none border-none p-1 text-yellow-900 opacity-50 hover:text-yellow-900 hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
                    data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h1 class="text-left font-serif text-4xl font-bold">{{ __('Profilbeállítások') }}</h1>
    </div>
@endsection


@section('content')
    <div class="mt-4 mb-10 w-full  bg-white p-4 shadow dark:bg-gray-800 sm:rounded-sm">
        <div class="container mx-auto">
            <h2 class="text-2x font-bold">{{ Auth::user()->name }}</h2>
            <small class="text-sm text-gray-700">{{ Auth::user()->email }}</small>
            <p class="w-96 py-3 text-gray-700">{{ Auth::user()->short_bio }}</p>
        </div>
    </div>

    <div style="width: 100%" class="mt-4 mb-10 w-full overflow-hidden bg-white p-4 shadow dark:bg-gray-800 sm:rounded-sm">
        <div class="container mx-auto">
            <h2 class="text-2x font-bold">Jelszó megváltoztatása</h2>

            <form action="{{ route('user.change.password') }}" method="POST" enctype="multipart/form-data"
                accept-charset="UTF-8">
                @method('PUT')
                @csrf

                <div class="mb-5 block">
                    <label for="password" class="form-label text-gray-700">{{ __('Régi jelszó') }}</label>
                    <input type="password" id="old_password" name="name" value="{{ old('old_password') }}"
                        class="form-control {{ $errors->has('old_password') ? ' border-rose-400' : '' }} mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        placeholder="">

                    @if ($errors->has('old_password'))
                        <div class="alert mt-2 text-sm text-rose-500">
                            {{ $errors->first('old_password') }}
                        </div>
                    @endif

                </div>

                <div class="mb-5 block">
                    <label for="new_password" class="form-label text-gray-700">{{ __('Új jelszó') }}</label>
                    <input type="password" id="new_password" name="new_password" value="{{ old('new_password') }}"
                        class="form-control {{ $errors->has('new_password') ? ' border-rose-400' : '' }} mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        placeholder="">

                    @if ($errors->has('new_password'))
                        <div class="alert mt-2 text-sm text-rose-500">
                            {{ $errors->first('new_password') }}
                        </div>
                    @endif
                </div>

                <div class="mb-5 block">
                    <label for="confirm_new_password"
                        class="form-label text-gray-700">{{ __('Új jelszó még egyszer') }}</label>
                    <input type="password" id="confirm_new_password" name="confirm_new_password" value=""
                        class="form-control {{ $errors->has('confirm_new_password') ? ' border-rose-400' : '' }} mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        placeholder="">

                    @if ($errors->has('confirm_new_password'))
                        <div class="alert mt-2 text-sm text-rose-500">
                            {{ $errors->first('confirm_new_password') }}
                        </div>
                    @endif
                </div>

                <div class="block">
                    <div class="flex flex-row gap-x-2">
                        <button type="submit"
                            class="inline-block cursor-pointer rounded bg-blue-600 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg">Megváltoztat</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
